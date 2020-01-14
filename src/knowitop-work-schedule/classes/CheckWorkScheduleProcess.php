<?php

/**
 * @copyright   Copyright (C) 2019 Vladimir Kunin https://knowitop.ru
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
		// TODO: is it my mistake?
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
				CMDBObject::SetTrackInfo("Automatic - Work Schedule");
				$oMyChange = CMDBObject::GetCurrentChange();
				$oWorkSchedule->DBUpdateTracked($oMyChange);
			}
		}
		$iProcessed = count($aProcessedSchedules);

		return "Processed $iProcessed schedule(s): ".implode(", ", $aProcessedSchedules);
	}
}
