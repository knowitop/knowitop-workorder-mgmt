<?php
/**
 * Localized data
 *
 * @copyright   Copyright (C) 2019 Vladimir Kunin https://knowitop.ru
 */

//
// Class: WorkOrder
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:WorkOrder/Attribute:ref' => 'Ref',
	'Class:WorkOrder/Attribute:ref+' => '',
	'Class:WorkOrder/Attribute:status/Value:new' => 'new',
	'Class:WorkOrder/Attribute:status/Value:new+' => '',
	'Class:WorkOrder/Attribute:status/Value:assigned' => 'assigned',
	'Class:WorkOrder/Attribute:status/Value:assigned+' => '',
	'Class:WorkOrder/Attribute:start_date' => 'Actual start date',
	'Class:WorkOrder/Attribute:start_date+' => '',
	'Class:WorkOrder/Attribute:end_date' => 'Actual end date',
	'Class:WorkOrder/Attribute:end_date+' => '',
	'Class:WorkOrder/Attribute:ticket_org' => 'Organization',
	'Class:WorkOrder/Attribute:ticket_org+' => '',
	'Class:WorkOrder/Attribute:planned_start_date' => 'Planned start date',
	'Class:WorkOrder/Attribute:planned_start_date+' => '',
	'Class:WorkOrder/Attribute:planned_end_date' => 'Planned end date',
	'Class:WorkOrder/Attribute:planned_end_date+' => '',
	'Class:WorkOrder/Attribute:solution' => 'Solution',
	'Class:WorkOrder/Attribute:solution+' => '',
	'Class:WorkOrder/Attribute:functionalcis_list' => 'CIs',
	'Class:WorkOrder/Attribute:functionalcis_list+' => 'All the configuration items related with this work order.',
	'Class:WorkOrder/Attribute:ticket_org_friendlyname' => 'Organization',
	'Class:WorkOrder/Attribute:ticket_org_friendlyname+' => '',
	'Class:WorkOrder/Stimulus:ev_assign' => 'Assign',
	'Class:WorkOrder/Stimulus:ev_assign+' => '',
	'Class:WorkOrder/Stimulus:ev_start' => 'Start',
	'Class:WorkOrder/Stimulus:ev_start+' => '',
	'Class:WorkOrder/Stimulus:ev_close' => 'Close',
	'Class:WorkOrder/Stimulus:ev_close+' => '',
));

//
// Class: lnkFunctionalCIToWorkOrder
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkFunctionalCIToWorkOrder' => 'Link FunctionalCI / WorkOrder',
	'Class:lnkFunctionalCIToWorkOrder+' => '',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:workorder_id' => 'Work order',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:workorder_id+' => '',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:functionalci_id' => 'CI',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:functionalci_id+' => '',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:functionalci_name' => 'CI',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:functionalci_name+' => '',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:workorder_id_friendlyname' => 'Work order',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:workorder_id_friendlyname+' => 'Work order',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:functionalci_id_friendlyname' => 'CI',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:functionalci_id_friendlyname+' => 'CI',
));