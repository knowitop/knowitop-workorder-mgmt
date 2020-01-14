<?php
/**
 * Localized data
 *
 * @copyright   Copyright (C) 2019 Vladimir Kunin https://knowitop.ru
 */

//
// Class: WorkSchedule
//

Dict::Add('RU RU', 'Russian', 'Русский', array(
	'Class:WorkSchedule' => 'График работ',
	'Class:WorkSchedule+' => 'Плановые периодические действия и задачи',
	'Class:WorkSchedule/Attribute:service_id' => 'Услуга',
	'Class:WorkSchedule/Attribute:service_id+' => 'Услуга',
	'Class:WorkSchedule/Attribute:service_name' => 'Услуга',
	'Class:WorkSchedule/Attribute:service_name+' => 'Услуга',
	'Class:WorkSchedule/Attribute:servicesubcategory_id' => 'Подкатегория',
	'Class:WorkSchedule/Attribute:servicesubcategory_id+' => 'Подкатегория',
	'Class:WorkSchedule/Attribute:servicesubcategory_name' => 'Подкатегория',
	'Class:WorkSchedule/Attribute:servicesubcategory_name+' => 'Подкатегория',
	'Class:WorkSchedule/Attribute:status' => 'Статус',
	'Class:WorkSchedule/Attribute:status+' => '',
	'Class:WorkSchedule/Attribute:status/Value:inactive' => 'Неактивный',
	'Class:WorkSchedule/Attribute:status/Value:inactive+' => '',
	'Class:WorkSchedule/Attribute:status/Value:active' => 'Активный',
	'Class:WorkSchedule/Attribute:status/Value:active+' => '',
	'Class:WorkSchedule/Attribute:next_wo_start_date' => 'Дата начала след. наряда',
	'Class:WorkSchedule/Attribute:next_wo_start_date+' => '',
	'Class:WorkSchedule/Attribute:prev_wo_start_date' => 'Дата начала посл. наряда',
	'Class:WorkSchedule/Attribute:prev_wo_start_date+' => '',
	'Class:WorkSchedule/Attribute:next_wo_create_date' => 'Дата создания след. наряда',
	'Class:WorkSchedule/Attribute:next_wo_create_date+' => 'Когда будет создан следующий наряд на работу',
	'Class:WorkSchedule/Attribute:pre_create_interval' => 'Предварительное создания наряда',
	'Class:WorkSchedule/Attribute:pre_create_interval+' => 'За сколько времени до начала работ создавать наряд',
	'Class:WorkSchedule/Attribute:wo_template_id' => 'Шаблон наряда',
	'Class:WorkSchedule/Attribute:wo_template_id+' => '',
	'Class:WorkSchedule/Attribute:wo_template_name' => 'Название наряда',
	'Class:WorkSchedule/Attribute:wo_template_name+' => '',
	'Class:WorkSchedule/Attribute:wo_template_description' => 'Описание наряда',
	'Class:WorkSchedule/Attribute:wo_template_description+' => '',
	'Class:WorkSchedule/Attribute:wo_template_team' => 'Команда наряда',
	'Class:WorkSchedule/Attribute:wo_template_team+' => '',
	'Class:WorkSchedule/Attribute:wo_template_agent' => 'Агент наряда',
	'Class:WorkSchedule/Attribute:wo_template_agent+' => '',
	'Class:WorkSchedule/Attribute:wo_template_duration' => 'Продолжительность работ',
	'Class:WorkSchedule/Attribute:wo_template_duration+' => 'Продолжительность работ по наряду',
	'Class:WorkSchedule/Attribute:document_list' => 'Документы',
	'Class:WorkSchedule/Attribute:document_list+' => 'Документы',
	'Class:WorkSchedule/Attribute:functionalcis_list' => 'КЕ',
	'Class:WorkSchedule/Attribute:functionalcis_list+' => 'Связанные конфигурационные единицы',
	'Class:WorkSchedule/Attribute:service_id_friendlyname' => 'Услуга',
	'Class:WorkSchedule/Attribute:service_id_friendlyname+' => 'Услуга',
	'Class:WorkSchedule/Attribute:servicesubcategory_id_friendlyname' => 'Подкатегория',
	'Class:WorkSchedule/Attribute:servicesubcategory_id_friendlyname+' => 'Подкатегория',
	'Class:WorkSchedule/Attribute:wo_template_id_friendlyname' => 'Шаблон наряда',
	'Class:WorkSchedule/Attribute:wo_template_id_friendlyname+' => 'Шаблон наряда',

	'WorkSchedule:baseinfo' => 'Основное',
	'WorkSchedule:schedule' => 'Расписание',
	'WorkSchedule:moreinfo' => 'Дополнительно',
	'WorkSchedule:contacts' => 'Контакты',
	'WorkSchedule:template' => 'Шаблон наряда',

	'Menu:WorkOrderManagement' => 'Управление работами',
	'Menu:WorkOrderManagement+' => 'Управление работами',
	'Menu:WorkOrderMgmt:Overview' => 'Обзор',
	'Menu:WorkOrderMgmt:Overview+' => 'Управление работами – Обзор',
	'Menu:WorkOrderMgmt:Shortcuts' => 'Наряды на работу',
	'Menu:Calendar:Overview' => 'Календарь работ',
	'Menu:Calendar:Overview+' => 'Календарь работ',
	'UI:WorkOrderMgmtMenuOverview:Title' => 'Панель управления работами',
	'UI:WorkOrderMgmtMenuOverview:Title+' => 'Панель управления работами',
	'UI:WorkOrderMgmtMenuOverview:WOsOutOfPlanLast14DaysPerTeam' => 'Наряды вне планового диапазона времени за последние 14 дней (по команде)',
	'UI:WorkOrderMgmtMenuOverview:WOsScheduledFor14Days' => 'Наряды на работу, запланированные на 14 дней',
	'UI:WorkOrderMgmtMenuOverview:WOsPlannedStartDatePassed' => 'Текущие наряды с пропущенной датой начала',
	'UI:WorkOrderMgmtMenuOverview:WOsPlannedEndDatePassed' => 'Текущие наряды с пропущенной датой окончания',
	'UI:WorkOrderMgmtMenuOverview:WOsByStatus' => 'Текущие наряды по статусу',
	'UI:WorkOrderMgmtMenuOverview:WOsByAgent' => 'Текущие наряды по агенту',
	'UI:WorkOrderMgmtMenuOverview:WOsScheduledLessThen1HourBeforeStart' => 'Наряды, созданные менее чем за час до планового начала за последние 14 дней (по команде)',
	'UI:WorkOrderCalendar:Title' => 'Календарь работ',
	'UI:WorkOrderCalendar:Title+' => 'Календарь работ',

	'UI:WorkSchedule:FurtherWorkPlannedFor_StartDate_CreateDate' => 'Следующие работы по графику запланированы на %1$s (создание наряда в %2$s).',

	'Menu:WorkOrderMgmt:NewWorkOrder' => 'Новый наряд',
	'Menu:WorkOrderMgmt:NewWorkOrder+' => 'Новый наряд на рабоу',
	'Menu:WorkOrderMgmt:MyWorkOrders' => 'Назначенные мне',
	'Menu:WorkOrderMgmt:MyWorkOrders+' => 'Назначенные мне наряды на работу',
	'Menu:WorkOrderMgmt:OpenWorkOrders' => 'Открытые наряды',
	'Menu:WorkOrderMgmt:OpenWorkOrders+' => 'Открытые наряды на работу',
	'Menu:WorkOrderMgmt:SearchWorkOrder' => 'Поиск нарядов',
	'Menu:WorkOrderMgmt:SearchWorkOrder+' => 'Найти наряды на работу',

	'Menu:WorkSchedule:Shortcuts' => 'Графики работ',
	'Menu:WorkSchedule:Shortcuts+' => 'Графики работ',
	'Menu:WorkSchedule:NewWorkSchedule' => 'Новый график работ',
	'Menu:WorkSchedule:NewWorkSchedule+' => 'Создать график работ',
	'Menu:WorkSchedule:AllWorkSchedule' => 'Все графики работ',
	'Menu:WorkSchedule:AllWorkSchedule+' => 'Все графики работ',

	'Menu:WorkOrderMgmt:AllWorkOrderTemplates' => 'Шаблоны нарядов',
	'Menu:WorkOrderMgmt:AllWorkOrderTemplates+' => 'Шаблоны нарядов на работу',
));

//
// Class: FixedWorkSchedule
//

Dict::Add('RU RU', 'Russian', 'Русский', array(
	'Class:FixedWorkSchedule' => 'Фиксированный график работ',
	'Class:FixedWorkSchedule+' => 'Плановые периодические действия и задачи по фиксированному расписанию',
	'Class:FixedWorkSchedule/Attribute:work_periodicity_pattern' => 'Периодичность',
	'Class:FixedWorkSchedule/Attribute:work_periodicity_pattern+' => 'Шаблон периодичности формата Crontab',
	'Class:FixedWorkSchedule/Attribute:work_periodicity_pattern?' => 'Проверить можно здесь: http://crontab.guru/
*    *    *    *    *    *
-    -    -    -    -    -
|    |    |    |    |    |
|    |    |    |    |    + Год [опционально]
|    |    |    |    +----- День недели (0 - 7) (Воскресенье =0 или =7)
|    |    |    +---------- Месяц (1 - 12)
|    |    +--------------- День месяца (1 - 31)
|    +-------------------- Час (0 - 23)
+------------------------- Минута (0 - 59)',
	'Class:FixedWorkSchedule/Attribute:work_periodicity_text' => 'Периодичность (текст)',
	'Class:FixedWorkSchedule/Attribute:work_periodicity_text+' => '',
	'Class:FixedWorkSchedule/Stimulus:ev_activate' => 'Активировать',
	'Class:FixedWorkSchedule/Stimulus:ev_activate+' => '',
	'Class:FixedWorkSchedule/Stimulus:ev_deactivate' => 'Деактивировать',
	'Class:FixedWorkSchedule/Stimulus:ev_deactivate+' => '',
));

//
// Class: IntervalWorkSchedule
//

Dict::Add('RU RU', 'Russian', 'Русский', array(
	'Class:IntervalWorkSchedule' => 'Интервальный график работ',
	'Class:IntervalWorkSchedule+' => 'Плановые периодические действия и задачи через определенный интервал',
	'Class:IntervalWorkSchedule/Attribute:work_interval_value' => 'Интервал',
	'Class:IntervalWorkSchedule/Attribute:work_interval_value+' => 'Значение интервала',
	'Class:IntervalWorkSchedule/Attribute:work_start_time' => 'Время начала работ',
	'Class:IntervalWorkSchedule/Attribute:work_start_time+' => '',
	'Class:IntervalWorkSchedule/Attribute:work_interval_unit' => 'Единицы',
	'Class:IntervalWorkSchedule/Attribute:work_interval_unit+' => 'Единицы интервала',
	'Class:IntervalWorkSchedule/Attribute:work_interval_unit/Value:day' => 'День',
	'Class:IntervalWorkSchedule/Attribute:work_interval_unit/Value:week' => 'Неделя',
	'Class:IntervalWorkSchedule/Attribute:work_interval_unit/Value:month' => 'Месяц',
	'Class:IntervalWorkSchedule/Stimulus:ev_activate' => 'Активировать',
	'Class:IntervalWorkSchedule/Stimulus:ev_activate+' => '',
	'Class:IntervalWorkSchedule/Stimulus:ev_deactivate' => 'Деактивировать',
	'Class:IntervalWorkSchedule/Stimulus:ev_deactivate+' => '',
));


//
// Class: lnkDocumentToTicket
//

Dict::Add('RU RU', 'Russian', 'Русский', array(
	'Class:lnkDocumentToTicket' => 'Связь Документ/Тикет',
	'Class:lnkDocumentToTicket+' => 'Связь Документ/Тикет',
	'Class:lnkDocumentToTicket/Attribute:ticket_id' => 'Тикет',
	'Class:lnkDocumentToTicket/Attribute:ticket_id+' => '',
	'Class:lnkDocumentToTicket/Attribute:document_id' => 'Документ',
	'Class:lnkDocumentToTicket/Attribute:document_id+' => '',
	'Class:lnkDocumentToTicket/Attribute:document_type' => 'Тип документа',
	'Class:lnkDocumentToTicket/Attribute:document_type+' => '',
	'Class:lnkDocumentToTicket/Attribute:ticket_id_friendlyname' => 'Тикет',
	'Class:lnkDocumentToTicket/Attribute:ticket_id_friendlyname+' => 'Тикет',
	'Class:lnkDocumentToTicket/Attribute:document_id_friendlyname' => 'Документ',
	'Class:lnkDocumentToTicket/Attribute:document_id_friendlyname+' => 'Документ',
));

//
// Class: WorkOrderTemplate
//

Dict::Add('RU RU', 'Russian', 'Русский', array(
	'Class:WorkOrderTemplate/Attribute:workschedules_list' => 'Графики работ',
	'Class:WorkOrderTemplate/Attribute:workschedules_list+' => 'Графики работ, в которых используется шаблон',
));