<?php
/**
 * Localized data
 *
 * @copyright   Copyright (C) 2019 Vladimir Kunin https://knowitop.ru
 */

//
// Class: WorkSchedule
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:WorkSchedule' => 'Work schedule',
	'Class:WorkSchedule+' => 'Scheduled periodic actions and tasks',
	'Class:WorkSchedule/Attribute:service_id' => 'Service',
	'Class:WorkSchedule/Attribute:service_id+' => 'Service',
	'Class:WorkSchedule/Attribute:service_name' => 'Service',
	'Class:WorkSchedule/Attribute:service_name+' => 'Service',
	'Class:WorkSchedule/Attribute:servicesubcategory_id' => 'Subcategory',
	'Class:WorkSchedule/Attribute:servicesubcategory_id+' => 'Subcategory',
	'Class:WorkSchedule/Attribute:servicesubcategory_name' => 'Subcategory',
	'Class:WorkSchedule/Attribute:servicesubcategory_name+' => 'Subcategory',
	'Class:WorkSchedule/Attribute:status' => 'Status',
	'Class:WorkSchedule/Attribute:status+' => '',
	'Class:WorkSchedule/Attribute:status/Value:inactive' => 'inactive',
	'Class:WorkSchedule/Attribute:status/Value:inactive+' => '',
	'Class:WorkSchedule/Attribute:status/Value:active' => 'active',
	'Class:WorkSchedule/Attribute:status/Value:active+' => '',
	'Class:WorkSchedule/Attribute:next_wo_start_date' => 'Next work order start date',
	'Class:WorkSchedule/Attribute:next_wo_start_date+' => '',
	'Class:WorkSchedule/Attribute:prev_wo_start_date' => 'Prev work order start date',
	'Class:WorkSchedule/Attribute:prev_wo_start_date+' => '',
	'Class:WorkSchedule/Attribute:next_wo_create_date' => 'Next work order create date',
	'Class:WorkSchedule/Attribute:next_wo_create_date+' => 'The date when the next work order will be created',
	'Class:WorkSchedule/Attribute:pre_create_interval' => 'Pre-create work order',
	'Class:WorkSchedule/Attribute:pre_create_interval+' => '',
	'Class:WorkSchedule/Attribute:wo_template_id' => 'Work order template',
	'Class:WorkSchedule/Attribute:wo_template_id+' => '',
	'Class:WorkSchedule/Attribute:wo_template_name' => 'Work order name',
	'Class:WorkSchedule/Attribute:wo_template_name+' => '',
	'Class:WorkSchedule/Attribute:wo_template_description' => 'Work order description',
	'Class:WorkSchedule/Attribute:wo_template_description+' => '',
	'Class:WorkSchedule/Attribute:wo_template_team' => 'Work order team',
	'Class:WorkSchedule/Attribute:wo_template_team+' => '',
	'Class:WorkSchedule/Attribute:wo_template_agent' => 'Work order agent',
	'Class:WorkSchedule/Attribute:wo_template_agent+' => '',
	'Class:WorkSchedule/Attribute:wo_template_duration' => 'Work duration',
	'Class:WorkSchedule/Attribute:wo_template_duration+' => 'Used to calculate planned start and end dates',
	'Class:WorkSchedule/Attribute:document_list' => 'Documents',
	'Class:WorkSchedule/Attribute:document_list+' => 'All related documents',
	'Class:WorkSchedule/Attribute:functionalcis_list' => 'CIs',
	'Class:WorkSchedule/Attribute:functionalcis_list+' => 'All related configuration items',
	'Class:WorkSchedule/Attribute:service_id_friendlyname' => 'Service',
	'Class:WorkSchedule/Attribute:service_id_friendlyname+' => 'Service',
	'Class:WorkSchedule/Attribute:servicesubcategory_id_friendlyname' => 'Subcategory',
	'Class:WorkSchedule/Attribute:servicesubcategory_id_friendlyname+' => 'Subcategory',
	'Class:WorkSchedule/Attribute:wo_template_id_friendlyname' => 'Work order template',
	'Class:WorkSchedule/Attribute:wo_template_id_friendlyname+' => 'Work order template',

	'WorkSchedule:baseinfo' => 'General information',
	'WorkSchedule:schedule' => 'Schedule',
	'WorkSchedule:moreinfo' => 'More information',
	'WorkSchedule:contacts' => 'Contacts',
	'WorkSchedule:template' => 'Work order template',

	'Menu:WorkOrderManagement' => 'Work Order Management',
	'Menu:WorkOrderManagement+' => 'Work Order Management',
	'Menu:WorkOrderMgmt:Overview' => 'Overview',
	'Menu:WorkOrderMgmt:Overview+' => 'Work Order Management – Overview',
	'Menu:WorkOrderMgmt:Shortcuts' => 'Work orders',
	'Menu:Calendar:Overview' => 'Calendar',
	'Menu:Calendar:Overview+' => 'Calendar',
	'UI:WorkOrderMgmtMenuOverview:Title' => 'Dashboard for Work Management',
	'UI:WorkOrderMgmtMenuOverview:Title+' => 'Dashboard for Work Management',
	'UI:WorkOrderMgmtMenuOverview:WOsOutOfPlanLast14DaysPerTeam' => 'Work orders out of the planned time range for the last 14 days (per team)',
	'UI:WorkOrderMgmtMenuOverview:WOsScheduledFor14Days' => 'Work orders scheduled for 14 days',
	'UI:WorkOrderMgmtMenuOverview:WOsPlannedStartDatePassed' => 'Work orders with a passed start date',
	'UI:WorkOrderMgmtMenuOverview:WOsPlannedEndDatePassed' => 'Work orders with a passed end date',
	'UI:WorkOrderMgmtMenuOverview:WOsByStatus' => 'Open work orders by status',
	'UI:WorkOrderMgmtMenuOverview:WOsByAgent' => 'Open work orders by agent',
	'UI:WorkOrderMgmtMenuOverview:WOsScheduledLessThen1HourBeforeStart' => 'Work orders created less than an hour before the planned start for the last 14 days (per team)',
	'UI:WorkOrderCalendar:Title' => 'Work calendar',
	'UI:WorkOrderCalendar:Title+' => 'Work calendar',

	'UI:WorkSchedule:FurtherWorkPlannedFor_StartDate_CreateDate' => 'The further work is scheduled for %1$s (work order will be created at %2$s).',

	'Menu:WorkOrderMgmt:NewWorkOrder' => 'New work order',
	'Menu:WorkOrderMgmt:NewWorkOrder+' => 'Create a new work order',
	'Menu:WorkOrderMgmt:MyWorkOrders' => 'Work orders assigned to me',
	'Menu:WorkOrderMgmt:MyWorkOrders+' => 'Work orders assigned to me',
	'Menu:WorkOrderMgmt:OpenWorkOrders' => 'Open work orders',
	'Menu:WorkOrderMgmt:OpenWorkOrders+' => 'Open work orders',
	'Menu:WorkOrderMgmt:SearchWorkOrder' => 'Search for work orders',
	'Menu:WorkOrderMgmt:SearchWorkOrder+' => 'Search for work orders',

	'Menu:WorkSchedule:Shortcuts' => 'Work schedules',
	'Menu:WorkSchedule:Shortcuts+' => 'Work schedules',
	'Menu:WorkSchedule:NewWorkSchedule' => 'New schedule',
	'Menu:WorkSchedule:NewWorkSchedule+' => 'Create a new work schedule',
	'Menu:WorkSchedule:AllWorkSchedule' => 'All schedules',
	'Menu:WorkSchedule:AllWorkSchedule+' => 'All schedules',

	'Menu:WorkOrderMgmt:AllWorkOrderTemplates' => 'Work order templates',
	'Menu:WorkOrderMgmt:AllWorkOrderTemplates+' => 'Work order templates',
));

//
// Class: FixedWorkSchedule
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:FixedWorkSchedule' => 'Fixed Work Schedule',
	'Class:FixedWorkSchedule+' => 'Planned periodic activities and tasks on a fixed schedule',
	'Class:FixedWorkSchedule/Attribute:work_periodicity_pattern' => 'Periodicity',
	'Class:FixedWorkSchedule/Attribute:work_periodicity_pattern+' => 'Crontab-like pattern check on https://crontab.guru',
	'Class:FixedWorkSchedule/Attribute:work_periodicity_pattern?' => 'Check your pattern on https://crontab.guru
*    *    *    *    *    *
-    -    -    -    -    -
|    |    |    |    |    |
|    |    |    |    |    + year [optional]
|    |    |    |    +----- day of week (0 - 7) (Sunday=0 or 7)
|    |    |    +---------- month (1 - 12)
|    |    +--------------- day of month (1 - 31)
|    +-------------------- hour (0 - 23)
+------------------------- min (0 - 59)',

	'Class:FixedWorkSchedule/Attribute:work_periodicity_text' => 'Periodicity (text)',
	'Class:FixedWorkSchedule/Attribute:work_periodicity_text+' => '',
	'Class:FixedWorkSchedule/Stimulus:ev_activate' => 'Activate',
	'Class:FixedWorkSchedule/Stimulus:ev_activate+' => '',
	'Class:FixedWorkSchedule/Stimulus:ev_deactivate' => 'Deactivate',
	'Class:FixedWorkSchedule/Stimulus:ev_deactivate+' => '',
));

//
// Class: IntervalWorkSchedule
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IntervalWorkSchedule' => 'Interval Work Schedule',
	'Class:IntervalWorkSchedule+' => 'Planned periodic actions and tasks at a certain interval',
	'Class:IntervalWorkSchedule/Attribute:work_interval_value' => 'Interval',
	'Class:IntervalWorkSchedule/Attribute:work_interval_value+' => 'Interval value',
	'Class:IntervalWorkSchedule/Attribute:work_start_time' => 'Work start time',
	'Class:IntervalWorkSchedule/Attribute:work_start_time+' => '',
	'Class:IntervalWorkSchedule/Attribute:work_interval_unit' => 'Units',
	'Class:IntervalWorkSchedule/Attribute:work_interval_unit+' => 'Interval units',
	'Class:IntervalWorkSchedule/Attribute:work_interval_unit/Value:day' => 'day',
	'Class:IntervalWorkSchedule/Attribute:work_interval_unit/Value:week' => 'week',
	'Class:IntervalWorkSchedule/Attribute:work_interval_unit/Value:month' => 'month',
	'Class:IntervalWorkSchedule/Stimulus:ev_activate' => 'Activate',
	'Class:IntervalWorkSchedule/Stimulus:ev_activate+' => '',
	'Class:IntervalWorkSchedule/Stimulus:ev_deactivate' => 'Deactivate',
	'Class:IntervalWorkSchedule/Stimulus:ev_deactivate+' => '',
));

//
// Class: lnkDocumentToTicket
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkDocumentToTicket' => 'Link Document/Ticket',
	'Class:lnkDocumentToTicket+' => 'Link Document/Ticket',
	'Class:lnkDocumentToTicket/Attribute:ticket_id' => 'Ticket',
	'Class:lnkDocumentToTicket/Attribute:ticket_id+' => '',
	'Class:lnkDocumentToTicket/Attribute:document_id' => 'Document',
	'Class:lnkDocumentToTicket/Attribute:document_id+' => '',
	'Class:lnkDocumentToTicket/Attribute:document_type' => 'Document type',
	'Class:lnkDocumentToTicket/Attribute:document_type+' => '',
	'Class:lnkDocumentToTicket/Attribute:ticket_id_friendlyname' => 'Ticket',
	'Class:lnkDocumentToTicket/Attribute:ticket_id_friendlyname+' => 'Ticket',
	'Class:lnkDocumentToTicket/Attribute:document_id_friendlyname' => 'Document',
	'Class:lnkDocumentToTicket/Attribute:document_id_friendlyname+' => 'Document',
));

//
// Class: WorkOrderTemplate
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:WorkOrderTemplate/Attribute:workschedules_list' => 'Work schedules',
	'Class:WorkOrderTemplate/Attribute:workschedules_list+' => 'Work schedules that use the template',
));