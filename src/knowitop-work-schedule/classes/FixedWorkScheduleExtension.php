<?php

/**
 * @copyright   Copyright (C) 2019 Vladimir Kunin https://knowitop.ru
 *
 * Class FixedWorkScheduleExtension
 */
class FixedWorkScheduleExtension implements iApplicationUIExtension, iApplicationObjectExtension
{

	/* @var string */
	static $sCronExpressionAttCode = 'work_periodicity_pattern';
	/* @var string */
	static $sCronHumanTextAttCode = 'work_periodicity_text';
	/* @var string */
	static $sCronHumanTextParamName = 'work_periodicity_text';

	/**
	 * @param \DBObject $oObject
	 * @param \WebPage $oPage
	 * @param bool $bEditMode
	 *
	 * @throws \CoreException
	 */
	public function OnDisplayProperties($oObject, WebPage $oPage, $bEditMode = false)
	{
		if (!$this->IsTargetObject($oObject))
		{
			return;
		}

		$bDisplayWidget = false;
		$bDisplayWHumanText = false;
		$sOperation = utils::ReadParam('operation', '');
		switch ($sOperation)
		{
			case 'modify':
			case 'new':
				if (!$oObject->IsAttributeReadOnlyForCurrentState(self::$sCronExpressionAttCode))
				{
					$bDisplayWidget = true;
				}
				else
				{
					$bDisplayWHumanText = true;
				}
				break;

			case 'stimulus':
				$sStimulus = utils::ReadParam('stimulus', '');
				$iFlags = $oObject->GetTransitionFlags(self::$sCronExpressionAttCode, $sStimulus);
				if ($iFlags & (OPT_ATT_MUSTPROMPT | OPT_ATT_MUSTCHANGE))
				{
					$bDisplayWidget = true;
				}
				$bDisplayWHumanText = true;
				break;

			default:
				$bDisplayWHumanText = true;
		}
		if ($bDisplayWidget)
		{
			$this->DisplayCronWidget($oPage);
		}
		if ($bDisplayWHumanText)
		{
			$this->DisplayCronHumanText($oObject, $oPage);
		}
	}

	/**
	 * @param \DBObject $oObject
	 * @param \WebPage $oPage
	 * @param bool $bEditMode
	 */
	public function OnDisplayRelations($oObject, WebPage $oPage, $bEditMode = false)
	{
	}

	/**
	 * @param \DBObject $oObject
	 * @param string $sFormPrefix
	 *
	 * @throws \CoreUnexpectedValue
	 */
	public function OnFormSubmit($oObject, $sFormPrefix = '')
	{
		if (!$this->IsTargetObject($oObject))
		{
			return;
		}

		$sText = utils::ReadParam(self::$sCronHumanTextParamName, '', false, 'string');
		if ($sText)
		{
			$oObject->Set(self::$sCronHumanTextAttCode, $sText);
		}
	}

	/**
	 * @param string $sTempId
	 */
	public function OnFormCancel($sTempId)
	{
	}

	/**
	 * @param \DBObject $oObject
	 *
	 * @return array|string[]
	 */
	public function EnumUsedAttributes($oObject)
	{
		return array();
	}

	/**
	 * @param \DBObject $oObject
	 *
	 * @return string
	 */
	public function GetIcon($oObject)
	{
		return '';
	}

	/**
	 * @param \DBObject $oObject
	 *
	 * @return int|string
	 */
	public function GetHilightClass($oObject)
	{
		return HILIGHT_CLASS_NONE;
	}

	/**
	 * @param \DBObjectSet $oSet
	 *
	 * @return array|string
	 */
	public function EnumAllowedActions(DBObjectSet $oSet)
	{
		return array();
	}

	/**
	 * @param \DBObject $oObject
	 *
	 * @return bool
	 */
	public function OnIsModified($oObject)
	{
		return false;
	}

	/**
	 * @param \DBObject $oObject
	 *
	 * @return array|string[]
	 */
	public function OnCheckToWrite($oObject)
	{
		if ($this->IsTargetObject($oObject))
		{
			$aChanges = array_keys($oObject->ListChanges());
			if (in_array(self::$sCronExpressionAttCode, $aChanges) && !in_array(self::$sCronHumanTextAttCode, $aChanges))
			{
				$oObject->Reset(self::$sCronHumanTextAttCode);
			}
		}

		return array();
	}

	/**
	 * @param \DBObject $oObject
	 *
	 * @return array|string[]
	 */
	public function OnCheckToDelete($oObject)
	{
		return array();
	}

	/**
	 * @param \DBObject $oObject
	 * @param null $oChange
	 */
	public function OnDBUpdate($oObject, $oChange = null)
	{
	}

	/**
	 * @param \DBObject $oObject
	 * @param null $oChange
	 */
	public function OnDBInsert($oObject, $oChange = null)
	{
	}

	/**
	 * @param \DBObject $oObject
	 * @param null $oChange
	 */
	public function OnDBDelete($oObject, $oChange = null)
	{
	}

	/// SPECIFIC METHODS ///

	/**
	 * @param \DBObject $oObject
	 *
	 * @return bool
	 */
	protected function IsTargetObject(DBObject $oObject)
	{
		return $oObject instanceof FixedWorkSchedule;
	}

	/**
	 * @param \WebPage $oPage
	 */
	protected function DisplayCronWidget(WebPage $oPage)
	{
		// TODO: предусмотреть отключение плагина в конфиге?
		$oPage->add_linked_stylesheet(utils::GetCurrentModuleUrl().'/vendor/arnapou/jqcron/src/jqCron.css');
		$oPage->add_linked_script(utils::GetCurrentModuleUrl().'/vendor/arnapou/jqcron/src/jqCron.js');

		$sJSLangShort = \Knowitop\Helper::GetUserLanguageISO639();
		// May not work with some languages because of different language spellings in iTop and jqCron
		$sFileName = \Knowitop\Helper::GetCurrentModulePath()."/vendor/arnapou/jqcron/src/jqCron.$sJSLangShort.js";
		if (!file_exists($sFileName))
		{
			$sJSLangShort = 'en';
		}
		$oPage->add_linked_script(utils::GetCurrentModuleUrl()."/vendor/arnapou/jqcron/src/jqCron.$sJSLangShort.js");
		// TODO: параметры в конфиг добавить?
		$aParams = [
			'minutes' => [0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55],
			'multiple_dom' => true,
			'multiple_month' => true,
			'multiple_dow' => true,
			// 'multiple_mins' => true,
			// 'multiple_time_hours' => true,
			// 'multiple_time_minutes' => true,
			'default_period' => 'month',
			'default_value' => '00 12 * * 1-5',
			'numeric_zero_pad' => true,
			'lang' => $sJSLangShort,
		];
		$sParams = json_encode($aParams);
		$sCronHumanTextParamName = self::$sCronHumanTextParamName;
		$sCronExpressionAttCode = self::$sCronExpressionAttCode;
		$oPage->add_ready_script(
			<<<EOF
var cronExpElement = $('#'+oWizardHelper.GetFieldId('$sCronExpressionAttCode')).attr('type', 'hidden');
var cronTextElement = $('<input>', {type: 'hidden', maxlength: 255, name: '$sCronHumanTextParamName'}).insertAfter(cronExpElement);

var cronParams = $sParams;
cronParams.bind_to = cronExpElement;
cronParams.bind_method = {
	set: function (element, value) {
		element.val(value).trigger('change');
	}
};
var cron = cronExpElement.jqCron(cronParams).jqCronGetInstance();
cronTextElement.val(cron.getHumanText());
cronExpElement.on('change', function () {
	setTimeout(function () {
		cronTextElement.val(cron.getHumanText());
	}, 0);
});

EOF
		);
	}

	/**
	 * @param \DBObject $oObject
	 * @param \WebPage $oPage
	 *
	 * @throws \CoreException
	 */
	protected function DisplayCronHumanText(DBObject $oObject, WebPage $oPage)
	{
		$sText = $oObject->Get(self::$sCronHumanTextAttCode);
		if (empty($sText))
		{
			$sText = $oObject->Get(self::$sCronExpressionAttCode);
		}
		$oPage->add_ready_script("$('.field_container[data-attribute-code=".self::$sCronExpressionAttCode."]').find('div.field_value').text('$sText');");
	}
}
