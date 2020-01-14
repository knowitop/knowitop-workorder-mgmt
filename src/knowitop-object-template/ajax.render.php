<?php

require_once('../../approot.inc.php');
require_once(APPROOT.'/application/application.inc.php');
require_once(APPROOT.'/application/webpage.class.inc.php');
require_once(APPROOT.'/application/ajaxwebpage.class.inc.php');

/**
 * @param \DBObject $oObj
 *
 * @throws \ArchivedObjectException
 * @throws \CoreException
 * @throws \UserRightException
 * @throws \Exception
 */

try
{
	require_once(APPROOT.'/application/startup.inc.php');
	require_once(APPROOT.'/application/loginwebpage.class.inc.php');
	LoginWebPage::DoLoginEx(null /* any portal */, false);

	$oPage = new ajax_page("");
	$oPage->no_cache();
	$oPage->SetContentType('text/html');

	$sOperation = utils::ReadParam('operation', '');
	$sFilter = utils::ReadParam('filter', 'SELECT ObjectTemplate', false, 'string');
	$sId = utils::ReadParam('widget_id', null, false, 'string');
	$oWidget = new UISelectObjectTemplateDialog(DBObjectSearch::FromOQL($sFilter), $sId, 'multiple');
	switch ($sOperation)
	{
		case 'show_select_template_dlg':
			$oWidget->Display($oPage);
			break;

		case 'search_template':
			$oWidget->SearchTemplate($oPage);
			break;

		default:
			$oPage->p("Missing argument 'operation'");
	}
	$oPage->output();
} catch (Exception $e)
{
	// note: transform to cope with XSS attacks
	echo htmlentities($e->GetMessage(), ENT_QUOTES, 'utf-8');
	IssueLog::Error($e->getMessage()."\nDebug trace:\n".$e->getTraceAsString());
}

