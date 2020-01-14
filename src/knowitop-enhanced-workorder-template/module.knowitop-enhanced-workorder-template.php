<?php
//
// iTop module definition file
//

SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'knowitop-enhanced-workorder-template/1.0.0',
	array(
		// Identification
		//
		'label' => 'Enhanced Work Order – Templates Bridge',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
			'knowitop-enhanced-workorders/1.0.0',
			'knowitop-object-template/0.1.0'
		),
		'mandatory' => false,
		'visible' => false,
		'auto_select' => 'SetupInfo::ModuleIsSelected("knowitop-enhanced-workorders") && SetupInfo::ModuleIsSelected("knowitop-object-template")',

		// Components
		//
		'datamodel' => array(
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
		),
	)
);
