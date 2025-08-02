<?php
//
// iTop module definition file
//

SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'knowitop-work-schedule/1.3.2',
	array(
		// Identification
		//
		'label' => 'Work Schedule',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
			'itop-tickets/3.0.0',
			'itop-config-mgmt/3.0.0',
			'itop-profiles-itil/3.0.0',
			'knowitop-object-template-base/1.0.0',
			'knowitop-object-template-workorder/1.0.0',
			'knowitop-enhanced-workorders/1.2.0',
			'knowitop-dashlet-calendar/1.2.0'
		),
		'mandatory' => false,
		'visible' => true,

		// Components
		//
		'datamodel' => array(
			'vendor/autoload.php',
			'model.knowitop-work-schedule.php',
			'src/Hook/CheckWorkScheduleProcess.php',
		),
		'webservice' => array(
			
		),
		'data.struct' => array(
			// add your 'structure' definition XML files here,
		),
		'data.sample' => array(
			// add your sample data XML files here,
		),
		
		// Documentation
		//
		'doc.manual_setup' => '', // hyperlink to manual setup documentation, if any
		'doc.more_information' => '', // hyperlink to more information, if any 

		// Default settings
		//
		'settings' => array(
			// Module specific settings go here, if any
			'max_pre_create_interval' => 30, // Max interval in days (30 by default)
		),
	)
);

