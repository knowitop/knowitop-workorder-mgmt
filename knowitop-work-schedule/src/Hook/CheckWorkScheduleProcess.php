<?php

namespace Knowitop\iTop\Extension\WorkSchedule\Hook;

use AttributeDateTime;
use CMDBObject;
use DBObjectSearch;
use DBObjectSet;
use iBackgroundProcess;

/**
 * @copyright   Copyright (C) 2019-2022 Vladimir Kunin https://knowitop.ru
 *
 * Class CheckWorkScheduleProcess
 */
class CheckWorkScheduleProcess implements iBackgroundProcess
{
	public function GetPeriodicity(): int
	{
		return 60; // seconds
	}

	/**
	 * @param int $iTimeLimit
	 *
	 * @return string
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function Process($iTimeLimit): string
	{
		$aProcessedSchedules = array();
		$sNow = date(AttributeDateTime::GetSQLFormat());
		// We don't use NOW() function directly in OQL because of potential difference in time zones between PHP and MySQL.
		$sOQL = "SELECT WorkSchedule WHERE status = 'active' AND (next_wo_create_date != '' AND next_wo_create_date < '$sNow')";
		$oSet = new DBObjectSet(DBObjectSearch::FromOQL($sOQL));
		while ((time() < $iTimeLimit) && ($oWorkSchedule = $oSet->Fetch()))
		{
			/** @var \WorkSchedule $oWorkSchedule */
			$aCreatedWorkOrders = [];
			do
			{
				$oWorkOrder = $oWorkSchedule->CreateNextWorkOrder();
				$oWorkSchedule->UpdateDatesFromWorkOrder($oWorkOrder);
				$sNextWOCreateDate = $oWorkSchedule->Get('next_wo_create_date');
				$aCreatedWorkOrders[] = $oWorkOrder->GetName();
			} while ($sNextWOCreateDate && $sNextWOCreateDate <= $oWorkSchedule->GetNowDate());

			$aProcessedSchedules[] = $oWorkSchedule->GetName().': '.join(', ', $aCreatedWorkOrders);
			if ($oWorkSchedule->IsModified())
			{
				// TODO: more user friendly track info
                $oPrevChange = CMDBObject::GetCurrentChange();
                CMDBObject::SetTrackInfo("Automatic - Work Schedule");
				$oWorkSchedule->DBUpdate();
                CMDBObject::SetCurrentChange($oPrevChange);
			}
		}
		$iProcessed = count($aProcessedSchedules);

		return "Processed $iProcessed schedule(s): ".implode(", ", $aProcessedSchedules);
	}
}
