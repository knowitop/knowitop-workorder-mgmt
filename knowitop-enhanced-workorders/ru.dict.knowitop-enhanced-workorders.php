<?php
/**
 * Localized data
 *
 * @copyright   Copyright (C) 2019-2022 Vladimir Kunin https://knowitop.ru
 */

//
// Class: WorkOrder
//

Dict::Add('RU RU', 'Russian', 'Русский', array(
	// 'Class:WorkOrder' => 'Наряд на работу',
	// 'Class:WorkOrder+' => '',
	'Class:WorkOrder/Attribute:ref' => 'Номер',
	'Class:WorkOrder/Attribute:ref+' => '',
	'Class:WorkOrder/Attribute:status/Value:new' => 'Новый',
	'Class:WorkOrder/Attribute:status/Value:new+' => '',
	'Class:WorkOrder/Attribute:status/Value:assigned' => 'Назначен',
	'Class:WorkOrder/Attribute:status/Value:assigned+' => '',
	'Class:WorkOrder/Attribute:start_date' => 'Дата факт. начала',
	'Class:WorkOrder/Attribute:start_date+' => '',
	'Class:WorkOrder/Attribute:end_date' => 'Дата факт. окончания',
	'Class:WorkOrder/Attribute:end_date+' => '',
	'Class:WorkOrder/Attribute:ticket_org_id' => 'Организация',
	'Class:WorkOrder/Attribute:ticket_org_id+' => '',
	'Class:WorkOrder/Attribute:ticket_caller_id' => 'Инициатор род. тикета',
	'Class:WorkOrder/Attribute:ticket_caller_id+' => '',
	'Class:WorkOrder/Attribute:planned_start_date' => 'Дата план. начала',
	'Class:WorkOrder/Attribute:planned_start_date+' => '',
	'Class:WorkOrder/Attribute:planned_end_date' => 'Дата план. окончания',
	'Class:WorkOrder/Attribute:planned_end_date+' => '',
	'Class:WorkOrder/Attribute:solution' => 'Описание решения',
	'Class:WorkOrder/Attribute:solution+' => '',
	'Class:WorkOrder/Attribute:functionalcis_list' => 'КЕ',
	'Class:WorkOrder/Attribute:functionalcis_list+' => 'Связанные конфигурационные единицы',
	'Class:WorkOrder/Attribute:ticket_org_id_friendlyname' => 'Организация',
	'Class:WorkOrder/Attribute:ticket_org_id_friendlyname+' => '',
	'Class:WorkOrder/Stimulus:ev_assign' => 'Назначить',
	'Class:WorkOrder/Stimulus:ev_assign+' => '',
	'Class:WorkOrder/Stimulus:ev_start' => 'Начать',
	'Class:WorkOrder/Stimulus:ev_start+' => '',
	'Class:WorkOrder/Stimulus:ev_close' => 'Закрыть',
	'Class:WorkOrder/Stimulus:ev_close+' => '',
));

//
// Class: lnkFunctionalCIToWorkOrder
//

Dict::Add('RU RU', 'Russian', 'Русский', array(
	'Class:lnkFunctionalCIToWorkOrder' => 'Связь Функциональная КЕ/Наряд на работу',
	'Class:lnkFunctionalCIToWorkOrder+' => '',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:workorder_id' => 'Наряд на работу',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:workorder_id+' => '',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:functionalci_id' => 'КЕ',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:functionalci_id+' => '',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:functionalci_name' => 'КЕ',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:functionalci_name+' => '',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:workorder_id_friendlyname' => 'Наряд на работу',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:workorder_id_friendlyname+' => 'Наряд на работу',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:functionalci_id_friendlyname' => 'КЕ',
	'Class:lnkFunctionalCIToWorkOrder/Attribute:functionalci_id_friendlyname+' => 'КЕ',
));
