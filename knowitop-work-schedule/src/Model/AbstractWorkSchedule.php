<?php

namespace Knowitop\iTop\Extension\WorkSchedule\Model;

use AttributeDateTime;
use DateTime;
use Knowitop\iTop\Extension\WorkSchedule\ModuleConfig;
use MetaModel;
use Ticket;
use WorkOrder;

/**
 * При сохранении и активации WorkSchedule считаем и записываем первую next_wo_create_date:
 * - находим next_wo_start_date относительно max(start_date, prev_wo_start_date, now);
 * - вычитаем pre_create_interval из next_wo_start_date;
 * - получаем next_wo_create_date для создания ближайшего наряда;
 * - если она уже прошла, ставим now. 🤘
 *
 * CheckWorkSchedule ищет нужный WorkSchedule по наступлению next_wo_create_date.
 * Новый наряд создается со следующей по графику датой относительно prev_wo_start_date || now
 */
abstract class AbstractWorkSchedule extends Ticket
{
	/** @var string – formatted current time to use in all computations */
	protected $sNow;

	/**
	 * AbstractWorkSchedule constructor.
	 *
	 * @param array|null $aRow
	 * @param string $sClassAlias
	 * @param array|null $aAttToLoad
	 * @param array|null $aExtendedDataSpec
	 *
	 * @throws \Exception
	 */
	public function __construct(?array $aRow = null, string $sClassAlias = '', ?array $aAttToLoad = null, ?array $aExtendedDataSpec = null)
	{
		parent::__construct($aRow, $sClassAlias, $aAttToLoad, $aExtendedDataSpec);
		$this->sNow = (new DateTime())->setTimestamp(floor(time() / 60) * 60)->format(AttributeDateTime::GetInternalFormat());
	}

	/**
	 * Find the date the when work order should be STARTED within schedule's half-open interval [start_date, end_date).
	 *
	 * @param string $sCurrentDate
	 * @param bool $bIncludeCurrentDate
	 *
	 * @return string|null
	 * @throws \CoreException
	 */
	abstract public function FindNextWorkOrderStartDate(?string $sCurrentDate = '', bool $bIncludeCurrentDate = false): ?string;

	/**
	 * @return int
	 * @throws \CoreException
	 */
	public function GetWorkOrderCreateInterval(): int
	{
		$iValue = (int)$this->Get('pre_create_interval');
		$iMaxValue = ModuleConfig::Get('max_pre_create_interval') * 86400;

		return min($iValue, $iMaxValue);
	}

	/**
	 * @param string|null $sCurrentDate
	 * @param bool $bIncludeCurrentDate
	 *
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \Exception
	 */
	public function ComputeNextDates(?string $sCurrentDate = '', bool $bIncludeCurrentDate = false): void
	{
		if (empty($sCurrentDate)) {
			$bIncludeCurrentDate = true;
		}
		$sStartDate = $this->FindNextWorkOrderStartDate($sCurrentDate, $bIncludeCurrentDate);
		$sCreateDate = null;
		if ($sStartDate) {
			$iCreateDate = AttributeDateTime::GetAsUnixSeconds($sStartDate) - $this->GetWorkOrderCreateInterval();
			$sCreateDate = (new DateTime())->setTimestamp($iCreateDate)->format(AttributeDateTime::GetInternalFormat());
		}
		if ($sCreateDate && $this->sNow > $sCreateDate) {
			// the date has already come, then use now
			$sCreateDate = $this->sNow;
		}
		$this->Set('next_wo_start_date', $sStartDate);
		$this->Set('next_wo_create_date', $sCreateDate);
	}

	/**
	 * @param \WorkOrder $oWorkOrder
	 *
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 */
	public function UpdateDatesFromWorkOrder(WorkOrder $oWorkOrder): void
	{
		$sPrevStartDate = $oWorkOrder->Get(WO_START_DATE_ATTR);
		$this->Set('prev_wo_start_date', $sPrevStartDate);
		$this->ComputeNextDates($sPrevStartDate);
	}

	/**
	 * @return \WorkOrder
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \CoreWarning
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function CreateNextWorkOrder(): ?WorkOrder
	{
		$sNextWOStartDate = $this->Get('next_wo_start_date'); // ?: $this->FindNextWorkOrderStartDate();
		if (!$sNextWOStartDate) {
			return null;
		}
		/** @var \WorkOrderTemplate $oWorkOrderTemplate */
		$oWorkOrderTemplate = MetaModel::GetObject('WorkOrderTemplate', $this->Get('wo_template_id'), true);
		/** @var \WorkOrder $oWorkOrder */
		$oWorkOrder = $oWorkOrderTemplate->CreateTargetObject($this);
		/** @var \ormLinkSet $oLinkSet */
		$oLinkSet = $this->Get('functionalcis_list');
		foreach ($oLinkSet as $oLink) {
			$oWorkOrder->ExecAction('add_to_list', ['functionalci_id', 'functionalcis_list'], ['source' => $oLink]);
		}
		$oWorkOrder->Set(WO_START_DATE_ATTR, $sNextWOStartDate);
		$oWorkOrder->Set(WO_END_DATE_ATTR,
			intval(AttributeDateTime::GetAsUnixSeconds($sNextWOStartDate)) + $oWorkOrderTemplate->Get('wo_duration'));
		$oWorkOrder->DBInsertNoReload();

		return $oWorkOrder;
	}

	/**
	 * @return string
	 */
	public function GetNowDate(): string
	{
		return $this->sNow;
	}

	/**
	 * Mainly for tests
	 *
	 * @param string $sNow
	 */
	public function SetNowDate(string $sNow): void
	{
		$this->sNow = $sNow;
	}
}