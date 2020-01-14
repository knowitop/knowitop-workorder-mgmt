<?php
/**
 * Localized data
 *
 * @copyright   Copyright (C) 2019 Vladimir Kunin https://knowitop.ru
 */

//
// Class: ObjectTemplate
//

Dict::Add('RU RU', 'Russian', 'Русский', array(
	'Class:ObjectTemplate' => 'Шаблон объекта',
	'Class:ObjectTemplate+' => '',
	'Class:ObjectTemplate/Attribute:name' => 'Название',
	'Class:ObjectTemplate/Attribute:name+' => '',
	'Class:ObjectTemplate/Attribute:status' => 'Статус',
	'Class:ObjectTemplate/Attribute:status+' => '',
	'Class:ObjectTemplate/Attribute:status/Value:active' => 'Активный',
	'Class:ObjectTemplate/Attribute:status/Value:active+' => '',
	'Class:ObjectTemplate/Attribute:status/Value:inactive' => 'Неактивный',
	'Class:ObjectTemplate/Attribute:status/Value:inactive+' => '',
	'Class:ObjectTemplate/Attribute:description' => 'Описание',
	'Class:ObjectTemplate/Attribute:description+' => '',
	'Class:ObjectTemplate/Attribute:finalclass' => 'Подкласс',
	'Class:ObjectTemplate/Attribute:finalclass+' => '',

	'Menu:AllObjectTemplates' => 'Шаблоны',
	'Menu:ObjectTemplate' => 'Шаблоны',
	'Menu:ObjectTemplate+' => 'Шаблоны объектов',

	'ObjectTemplate:baseinfo' => 'Общие параметры',
	'ObjectTemplate:template' => 'Данные шаблона'
));

//
// Class: WorkOrderTemplate
//

Dict::Add('RU RU', 'Russian', 'Русский', array(
	'Class:WorkOrderTemplate' => 'Шаблон наряда на работу',
	'Class:WorkOrderTemplate+' => '',
	'Class:WorkOrderTemplate/Attribute:wo_name' => 'Название наряда',
	'Class:WorkOrderTemplate/Attribute:wo_name+' => '',
	'Class:WorkOrderTemplate/Attribute:wo_description' => 'Описание наряда',
	'Class:WorkOrderTemplate/Attribute:wo_description+' => '',
	'Class:WorkOrderTemplate/Attribute:wo_team_id' => 'Команда',
	'Class:WorkOrderTemplate/Attribute:wo_team_id+' => '',
	'Class:WorkOrderTemplate/Attribute:wo_team_name' => 'Команда',
	'Class:WorkOrderTemplate/Attribute:wo_team_name+' => '',
	'Class:WorkOrderTemplate/Attribute:wo_agent_id' => 'Агент',
	'Class:WorkOrderTemplate/Attribute:wo_agent_id+' => '',
	'Class:WorkOrderTemplate/Attribute:wo_agent_name' => 'Агент',
	'Class:WorkOrderTemplate/Attribute:wo_agent_name+' => '',
	'Class:WorkOrderTemplate/Attribute:wo_duration' => 'Продолжительность работ',
	'Class:WorkOrderTemplate/Attribute:wo_duration+' => '',
	'Class:WorkOrderTemplate/Attribute:wo_team_id_friendlyname' => 'Команда',
	'Class:WorkOrderTemplate/Attribute:wo_team_id_friendlyname+' => 'Команда',
	'Class:WorkOrderTemplate/Attribute:wo_agent_id_friendlyname' => 'Агент',
	'Class:WorkOrderTemplate/Attribute:wo_agent_id_friendlyname+' => 'Агент',
));

//
// Class: WorkOrder
//

Dict::Add('RU RU', 'Russian', 'Русский', array(
	'Class:WorkOrder/Attribute:template_key' => 'Шаблон',
	'Class:WorkOrder/Attribute:template_key+' => 'Номер шаблона, по которому создан объект',
));