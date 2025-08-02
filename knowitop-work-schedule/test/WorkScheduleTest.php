<?php

namespace Knowitop\iTop\Test\UnitTest\WorkSchedule;

use ChecklistTemplate;
use Combodo\iTop\Test\UnitTest\ItopDataTestCase;
use Exception;
use FixedWorkSchedule;
use IntervalWorkSchedule;
use lnkChecklistTemplateToWorkOrderTemplate;
use MetaModel;
use Team;
use WorkOrderTemplate;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 * @backupGlobals disabled
 */
class WorkScheduleTest extends ItopDataTestCase
{
	const CREATE_TEST_ORG = true;
	/**
	 * @throws Exception
	 */
	protected function setUp()
	{
		parent::setUp();
		require_once __DIR__ .'/../vendor/autoload.php';
	}

	/**
	 * @throws \Exception
	 */
	public function testIntervalWorkScheduleDates() {
		$oTeam = $this->createTeam(1);
		$oWOTemplate = $this->createWorkOrderTemplate(1, $oTeam->GetKey(), 45 * 60);
		$oWS = $this->createIntervalWorkSchedule(1,  $oWOTemplate->GetKey(), 1, 'day', "12:00", 60 * 60);
		$oWS->SetNowDate('1970-01-01 00:00:00');

		// Активируется заранее
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-01-01 12:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-01 11:00:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется меньше чем за pre_create_interval
		$oWS->SetNowDate('1970-01-01 11:59:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-01-01 12:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-01 11:59:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется точно во время начала первых работ
		$oWS->SetNowDate('1970-01-01 12:00:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-01-01 12:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-01 12:00:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется после времени начала первых работ
		$oWS->SetNowDate('1970-01-01 12:01:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-01-02 12:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-02 11:00:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Проверка границ start_date и end_date: [start; end)
		$oWS->Set('start_date', '1970-01-03 12:00:00');
		$oWS->Set('end_date', '1970-02-03 12:00:00');

		// Активируется до начала графика => первые работы совпадают с началом графика
		$oWS->SetNowDate('1970-01-01 00:00:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-01-03 12:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-03 11:00:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется меньше чем за pre_create_interval
		$oWS->SetNowDate('1970-01-03 11:59:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-01-03 12:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-03 11:59:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется точно во время начала первых работ
		$oWS->SetNowDate('1970-01-03 12:00:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-01-03 12:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-03 12:00:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется перед началом последних работ (в последний день графика)
		$oWS->SetNowDate('1970-02-02 11:59:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-02-02 12:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-02-02 11:59:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется после начала последних работ (в последний день графика)
		$oWS->SetNowDate('1970-02-02 12:01:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertNull($oWS->Get("next_wo_start_date"));
		$this->assertNull($oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется после окончания графика
		$oWS->SetNowDate('1970-02-03 12:00:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertNull($oWS->Get("next_wo_start_date"));
		$this->assertNull($oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Создание нарядов
		$oWS->SetNowDate('1970-01-03 00:00:00');
		$oWS->ApplyStimulus("ev_activate");
		$oWS->SetNowDate('1970-01-03 11:01:36'); // наступило время создания первого наряда

		$oWO1 = $oWS->CreateNextWorkOrder();
		$this->assertEquals('1970-01-03 12:00:00', $oWO1->Get("planned_start_date"));
		$this->assertEquals('1970-01-03 12:45:00', $oWO1->Get("planned_end_date"));

		$oWS->UpdateDatesFromWorkOrder($oWO1);
		$this->assertEquals('1970-01-03 12:00:00', $oWS->Get("prev_wo_start_date"));
		$this->assertNull($oWS->Get("next_wo_start_date"), "next_wo_start_date нет, пока есть открытый наряд.");
		$this->assertNull($oWS->Get("next_wo_create_date"), "next_wo_create_date нет, пока есть открытый наряд.");

		$oWO2 = $oWS->CreateNextWorkOrder();
		$this->assertNull($oWO2, "Новый наряд не создается, пока есть открытый наряд.");

		// Наряд закрыли точно в срок
		$oWS->SetNowDate('1970-01-03 12:45:00');
		$oWO1->Set("end_date", '1970-01-03 12:45:00');
		$oWO1->Set("status", "closed");
		$oWO1->DBWrite();
		$oWS->Reload();
		// Следующий будет завтра
		$this->assertEquals('1970-01-04 12:00:00', $oWS->Get("next_wo_start_date"));
		// $this->assertEquals('1970-01-04 11:00:00', $oWS->Get("next_wo_create_date")); // fixme: эта дата считается внутри $oWO1->DBWrite() в другой копии объекта расписания, в которой sNow берется из системы.

		// Наряд закрыли раньше срока (меньше чем на интервал работ)
		$oWS->SetNowDate('1970-01-03 11:23:41');
		$oWO1->Set("end_date", '1970-01-03 11:23:41');
		$oWO1->Set("status", "closed");
		$oWO1->DBWrite();
		$oWS->Reload();
		// Следующий всё равно только завтра
		$this->assertEquals('1970-01-04 12:00:00', $oWS->Get("next_wo_start_date"));

		// Наряд закрыли позже срока (больше чем на интервал работ)
		$oWS->SetNowDate('1970-01-06 18:41:05');
		$oWO1->Set("end_date", '1970-01-06 18:41:05');
		$oWO1->Set("status", "closed");
		$oWO1->DBWrite();
		$oWS->Reload();
		// Следующий всё равно только завтра
		$this->assertEquals('1970-01-07 12:00:00', $oWS->Get("next_wo_start_date"));

		///
		/// Легенда: техническое обслуживание, которое нужно делать не реже раза в неделю,
		/// но можно сделать чаще при удобном случае (напр., инженер на узле по другому поводу).
		///
		/// Интервал работ: 1 неделя
		/// Время начала работ: 22:00
		/// Продолжительность работ: 6 часов (переходит во вторые сутки)
		/// Предварительное создание наряда: 1 неделя
		///
		/// Начало расписания: 1970-02-01 12:00:00
		/// Конец расписания: 1970-03-01 12:00:00
		/// Примерные аты работ:
		/// 1970-02-01 22:00:00
		/// 1970-02-08 22:00:00
		/// 1970-02-15 22:00:00
		/// 1970-02-22 22:00:00
		///

		$oTeam = $this->createTeam(1);
		$oWOTemplate = $this->createWorkOrderTemplate(1, $oTeam->GetKey(), 60 * 60 * 6);
		$oWS = $this->createIntervalWorkSchedule(1,  $oWOTemplate->GetKey(), 1, 'week', "22:00", 60 * 60 * 24 * 7);
		$oWS->SetNowDate('1970-01-01 00:00:00');
		$this->debug("Current time: " . $oWS->GetNowDate());

		// Активируется меньше чем за pre_create_interval
		$oWS->SetNowDate('1970-01-01 11:59:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-01-01 22:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-01 11:59:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется точно во время начала первых работ
		$oWS->SetNowDate('1970-01-01 22:00:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-01-01 22:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-01 22:00:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется после времени начала первых работ
		$oWS->SetNowDate('1970-01-01 22:01:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-01-02 22:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-01 22:01:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Проверка границ start_date и end_date: [start; end)
		$oWS->Set('start_date', '1970-02-01 12:00:00');
		$oWS->Set('end_date', '1970-03-01 12:00:00');

		// Активируется до начала графика => первые работы совпадают с началом графика
		$oWS->SetNowDate('1970-01-01 00:00:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-02-01 22:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-25 22:00:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется меньше чем за pre_create_interval
		$oWS->SetNowDate('1970-01-31 21:20:14');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-02-01 22:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-31 21:20:14', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется точно во время начала первых работ
		$oWS->SetNowDate('1970-02-01 22:00:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-02-01 22:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-02-01 22:00:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется перед началом последних работ (в последний день графика)
		$oWS->SetNowDate('1970-02-28 21:59:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-02-28 22:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-02-28 21:59:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется после начала последних работ (в последний день графика)
		$oWS->SetNowDate('1970-02-28 22:01:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertNull($oWS->Get("next_wo_start_date"));
		$this->assertNull($oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется после окончания графика
		$oWS->SetNowDate('1970-03-01 10:00:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertNull($oWS->Get("next_wo_start_date"));
		$this->assertNull($oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Создание нарядов
		$oWS->SetNowDate('1970-01-01 00:00:00');
		$oWS->ApplyStimulus("ev_activate");
		$oWS->SetNowDate('1970-01-25 22:00:34'); // наступило время создания первого наряда

		$oWO1 = $oWS->CreateNextWorkOrder();
		$this->assertEquals('1970-02-01 22:00:00', $oWO1->Get("planned_start_date"));
		$this->assertEquals('1970-02-02 04:00:00', $oWO1->Get("planned_end_date"));

		$oWS->UpdateDatesFromWorkOrder($oWO1);
		$this->assertEquals('1970-02-01 22:00:00', $oWS->Get("prev_wo_start_date"));
		$this->assertNull($oWS->Get("next_wo_start_date"), "next_wo_start_date нет, пока есть открытый наряд.");
		$this->assertNull($oWS->Get("next_wo_create_date"), "next_wo_create_date нет, пока есть открытый наряд.");

		$oWO2 = $oWS->CreateNextWorkOrder();
		$this->assertNull($oWO2, "Новый наряд не создается, пока есть открытый наряд.");

		// Наряд закрыли точно в срок
		$oWS->SetNowDate('1970-02-02 04:00:00');
		$oWO1->Set("end_date", '1970-02-02 04:00:00');
		$oWO1->Set("status", "closed");
		$oWO1->DBWrite();
		$oWS->Reload();
		// Следующий будет через 7 дней от дня закрытия
		$this->assertEquals('1970-02-09 22:00:00', $oWS->Get("next_wo_start_date"));
		// $this->assertEquals('1970-01-04 11:00:00', $oWS->Get("next_wo_create_date")); // fixme: эта дата считается внутри $oWO1->DBWrite() в другой копии объекта расписания, в которой sNow берется из системы.

		// Наряд закрыли раньше срока в тот же день, когда открывали (!!!)
		$oWS->SetNowDate('1970-02-01 23:56:43');
		$oWO1->Set("end_date", '1970-02-01 23:56:43');
		$oWO1->Set("status", "closed");
		$oWO1->DBWrite();
		$oWS->Reload();
		// Следующий будет через 7 дней от дня закрытия
		$this->assertEquals('1970-02-08 22:00:00', $oWS->Get("next_wo_start_date"));

		// Наряд закрыли позже срока (меньше чем на интервал работ)
		$oWS->SetNowDate('1970-02-07 14:40:12');
		$oWO1->Set("end_date", '1970-02-07 14:40:12');
		$oWO1->Set("status", "closed");
		$oWO1->DBWrite();
		$oWS->Reload();
		// Следующий будет через 7 дней от дня закрытия
		$this->assertEquals('1970-02-14 22:00:00', $oWS->Get("next_wo_start_date"));

		// Наряд закрыли позже срока (больше чем на интервал работ)
		$oWS->SetNowDate('1970-02-09 11:21:04');
		$oWO1->Set("end_date", '1970-02-09 11:21:04');
		$oWO1->Set("status", "closed");
		$oWO1->DBWrite();
		$oWS->Reload();
		// Следующий будет через 7 дней от дня закрытия
		$this->assertEquals('1970-02-16 22:00:00', $oWS->Get("next_wo_start_date"));
	}

	/**
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 */
	public function testFixedWorkScheduleDates() {

		$oTeam = $this->createTeam(1);
		$oWOTemplate = $this->createWorkOrderTemplate(1, $oTeam->GetKey(), 45 * 60);
		$oWS = $this->createFixedWorkSchedule(1, '0 12 * * *', $oWOTemplate->GetKey(), 60 * 60);

		$oWS->SetNowDate('1970-01-01 00:00:00');

		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-01-01 12:00:00', $oWS->Get('next_wo_start_date'));
		$this->assertEquals('1970-01-01 11:00:00', $oWS->Get('next_wo_create_date'));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется меньше чем за pre_create_interval
		$oWS->SetNowDate('1970-01-01 11:59:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-01-01 12:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-01 11:59:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется точно во время начала первых работ
		$oWS->SetNowDate('1970-01-01 12:00:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-01-01 12:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-01 12:00:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется после времени начала первых работ
		$oWS->SetNowDate('1970-01-01 12:01:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-01-02 12:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-02 11:00:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Проверка границ start_date и end_date: [start; end)
		$oWS->Set('start_date', '1970-01-03 12:00:00');
		$oWS->Set('end_date', '1970-02-03 12:00:00');

		// Активируется до начала графика => первые работы совпадают с началом графика
		$oWS->SetNowDate('1970-01-01 00:00:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-01-03 12:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-03 11:00:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется меньше чем за pre_create_interval
		$oWS->SetNowDate('1970-01-03 11:59:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-01-03 12:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-03 11:59:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется точно во время начала первых работ
		$oWS->SetNowDate('1970-01-03 12:00:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-01-03 12:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-03 12:00:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется перед началом последних работ (в последний день графика)
		$oWS->SetNowDate('1970-02-02 11:59:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertEquals('1970-02-02 12:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-02-02 11:59:00', $oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется после начала последних работ (в последний день графика)
		$oWS->SetNowDate('1970-02-02 12:01:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertNull($oWS->Get("next_wo_start_date"));
		$this->assertNull($oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Активируется после окончания графика
		$oWS->SetNowDate('1970-02-03 12:00:00');
		$oWS->ApplyStimulus("ev_activate", true);
		$this->assertNull($oWS->Get("next_wo_start_date"));
		$this->assertNull($oWS->Get("next_wo_create_date"));
		$oWS->ApplyStimulus("ev_deactivate", true);

		// Создание нарядов
		$oWS->SetNowDate('1970-01-03 00:00:00');
		$oWS->ApplyStimulus("ev_activate");
		$oWS->SetNowDate('1970-01-03 11:01:36'); // наступило время создания первого наряда

		// Первый наряд
		$oWO1 = $oWS->CreateNextWorkOrder();
		$this->assertEquals('1970-01-03 12:00:00', $oWO1->Get("planned_start_date"));
		$this->assertEquals('1970-01-03 12:45:00', $oWO1->Get("planned_end_date"));

		$oWS->UpdateDatesFromWorkOrder($oWO1);
		$this->assertEquals('1970-01-03 12:00:00', $oWS->Get("prev_wo_start_date"));
		$this->assertEquals('1970-01-04 12:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-04 11:00:00', $oWS->Get("next_wo_create_date"));

		// Второй наряд
		$oWO2 = $oWS->CreateNextWorkOrder();
		$this->assertEquals('1970-01-04 12:00:00', $oWO2->Get("planned_start_date"));
		$this->assertEquals('1970-01-04 12:45:00', $oWO2->Get("planned_end_date"));

		$oWS->UpdateDatesFromWorkOrder($oWO2);
		$this->assertEquals('1970-01-04 12:00:00', $oWS->Get("prev_wo_start_date"));
		$this->assertEquals('1970-01-05 12:00:00', $oWS->Get("next_wo_start_date"));
		$this->assertEquals('1970-01-05 11:00:00', $oWS->Get("next_wo_create_date"));
	}

	public function testChecklistTemplateCreation() {
		$oTeam = $this->createTeam(1);
		$aItems = ['item 1', 'item 2'];
		$oActiveChecklistTemplate = $this->createChecklistTemplate(1, 'Checklist 1', $aItems, 'active');
		$oInactiveChecklistTemplate = $this->createChecklistTemplate(2, 'Checklist 2', $aItems, 'inactive');
		$oWOTemplate = $this->createWorkOrderTemplate(1, $oTeam->GetKey(), 45 * 60);
		$this->addChecklistTemplateToWorkOrderTemplate($oActiveChecklistTemplate, $oWOTemplate);
		$this->addChecklistTemplateToWorkOrderTemplate($oInactiveChecklistTemplate, $oWOTemplate);
		$oWOTemplate->DBUpdate();

		$oWS = $this->createIntervalWorkSchedule(1,  $oWOTemplate->GetKey(), 1, 'day', "12:00", 60 * 60);
		// Создание нарядов
		$oWS->SetNowDate('1970-01-03 00:00:00');
		$oWS->ApplyStimulus("ev_activate");
		$oWS->SetNowDate('1970-01-03 11:01:36'); // наступило время создания первого наряда

		$oWO1 = $oWS->CreateNextWorkOrder();
		$oActiveChecklist = MetaModel::GetObjectByColumn('Checklist', 'template_key', $oActiveChecklistTemplate->GetKey(),true);
		$this->assertEquals($oActiveChecklistTemplate->Get('checklist_title'), $oActiveChecklist->Get('title'));
		$this->assertEquals($oWO1->GetKey(), $oActiveChecklist->Get('obj_key'));
		$this->assertEquals(get_class($oWO1), $oActiveChecklist->Get('obj_class'));
		$this->assertEquals($oWO1->Get('ticket_org_id'), $oActiveChecklist->Get('obj_org_id'));
		/** @var \ormLinkSet $oItems */
		$oLinkSet = $oActiveChecklist->Get('items_list');
		$this->assertEquals(count($aItems), $oLinkSet->Count());

		$oInactiveChecklist = MetaModel::GetObjectByColumn('Checklist', 'template_key', $oInactiveChecklistTemplate->GetKey(),false);
		$this->assertNull($oInactiveChecklist);
	}

	/**
	 * @param int $iNum
	 * @param int|null $iWoTmplId
	 * @param int $iWorkIntervalValue
	 * @param string $sWorkIntervalUnit
	 * @param string $sWorkStartTime
	 * @param int $iPreCreateInterval
	 * @param int|null $iOrgId
	 *
	 * @return \IntervalWorkSchedule
	 * @throws \CoreException
	 */
	protected function createIntervalWorkSchedule(int $iNum, int $iWoTmplId, int $iWorkIntervalValue, string $sWorkIntervalUnit, string $sWorkStartTime, int $iPreCreateInterval, ?int $iOrgId = 0): IntervalWorkSchedule {
		$aParams = [
			"org_id" => $iOrgId ?: $this->getTestOrgId(),
			"title" => "TEST WORK SCHEDULE $iNum",
			"ref" => "Work_Schedule_$iNum",
			"description" => "Test",
			"work_interval_value" => $iWorkIntervalValue,
			"work_interval_unit" => $sWorkIntervalUnit,
			"work_start_time" => $sWorkStartTime,
			"wo_template_id" => $iWoTmplId,
			"pre_create_interval" => $iPreCreateInterval
		];
		/** @var \IntervalWorkSchedule $oObj */
		$oObj = $this->createObject("IntervalWorkSchedule", $aParams);
		$this->debug("Created " . get_class($oObj) . " " . $oObj->Get("ref"));
		return $oObj;
	}

	/**
	 * @param int $iNum
	 * @param string $sCronPattern
	 * @param int|null $iWoTmplId
	 * @param int $iPreCreateInterval
	 * @param int|null $iOrgId
	 *
	 * @return \FixedWorkSchedule
	 * @throws \CoreException
	 */
	protected function createFixedWorkSchedule(int $iNum, string $sCronPattern, int $iWoTmplId, int $iPreCreateInterval, ?int $iOrgId = 0): FixedWorkSchedule {
		$aParams = [
			"org_id" => $iOrgId ?: $this->getTestOrgId(),
			"title" => "TEST WORK SCHEDULE $iNum",
			"ref" => "Work_Schedule_$iNum",
			"description" => "Test",
			"work_periodicity_pattern" => $sCronPattern,
			"wo_template_id" => $iWoTmplId,
			"pre_create_interval" => $iPreCreateInterval
		];
		/** @var \FixedWorkSchedule $oObj */
		$oObj = $this->createObject("FixedWorkSchedule", $aParams);
		$this->debug("Created " . get_class($oObj) . " " . $oObj->Get("ref"));
		return $oObj;
	}

	/**
	 * @param int $iNum
	 * @param int $iTeamId
	 * @param int $iDuration
	 *
	 * @return \WorkOrderTemplate
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	protected function createWorkOrderTemplate(int $iNum, int $iTeamId, int $iDuration): WorkOrderTemplate {
		$aParams = [
			"name" => "TEST WORK ORDER TEMPLATE $iNum",
			"description" => "Test",
			"wo_name" => "WO name",
			"wo_description" => "WO desc",
			"wo_team_id" => $iTeamId,
			"wo_duration" => $iDuration
		];
		/** @var \WorkOrderTemplate $oObj */
		$oObj = $this->createObject("WorkOrderTemplate", $aParams);
		$this->debug("Created " . get_class($oObj) . " " . $oObj->Get("name"));
		return $oObj;
	}

	/**
	 * @param int $iNum
	 * @param string $sTitle
	 * @param array $aItems
	 * @param string $sStatus
	 *
	 * @return \ChecklistTemplate
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	protected function createChecklistTemplate(int $iNum, string $sTitle, array $aItems, string $sStatus = 'active'): ChecklistTemplate {
		$aParams = [
			"name" => "TEST CHECKLIST TEMPLATE $iNum",
			"status" => $sStatus,
			"description" => "Test",
			'checklist_title' => $sTitle,
			'checklist_items' => join("\n", $aItems),
		];
		/** @var \ChecklistTemplate $oObj */
		$oObj = $this->createObject("ChecklistTemplate", $aParams);
		$this->debug("Created " . get_class($oObj) . " {$oObj->Get("name")} ({$oObj->Get("status")})");
		return $oObj;
	}

	/**
	 * @param \ChecklistTemplate $oChecklistTemplate
	 * @param \WorkOrderTemplate $oWorkOrderTemplate
	 *
	 * @return \lnkChecklistTemplateToWorkOrderTemplate
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 */
	protected function addChecklistTemplateToWorkOrderTemplate(ChecklistTemplate $oChecklistTemplate, WorkOrderTemplate $oWorkOrderTemplate): lnkChecklistTemplateToWorkOrderTemplate
	{
		$oNewLink = new lnkChecklistTemplateToWorkOrderTemplate();
		$oNewLink->Set('checklist_template_id', $oChecklistTemplate->GetKey());
		$oChecklistTemplates = $oWorkOrderTemplate->Get('checklist_templates_list');
		$oChecklistTemplates->AddItem($oNewLink);
		$oWorkOrderTemplate->Set('checklist_templates_list', $oChecklistTemplates);

		$this->debug("Added {$oChecklistTemplate->GetName()} to {$oWorkOrderTemplate->GetName()}");

		return $oNewLink;
	}

	/**
	 * @param int $iNum
	 * @param int|null $iOrgId
	 *
	 * @return \Team
	 * @throws \CoreException
	 * @throws \Exception
	 */
	protected function createTeam(int $iNum, ?int $iOrgId = 0): Team {
		$aParams = [
			"org_id" => $iOrgId ?: $this->getTestOrgId(),
			"name" => "Test team $iNum"
		];
		/** @var \Team $oObj */
		$oObj = $this->createObject("Team", $aParams);
		$this->debug("Created " . get_class($oObj) . " " . $oObj->Get("name"));
		return $oObj;
	}

}
