<?php

namespace Knowitop\iTop\Extension\WorkSchedule\Attribute;

use AttributeString;
use Dict;
use Knowitop\iTop\Extension\WorkSchedule\Helper\AttributeCronExpressionHelper;

class AttributeCronExpression extends AttributeString
{
	const SEARCH_WIDGET_TYPE = self::SEARCH_WIDGET_TYPE_RAW;

	const VALIDATION_PATTERN = "^[\*,/\-0-9]+\s[\*,/\-0-9]+\s[\*,/\-\?LW0-9A-Za-z]+\s[\*,/\-0-9A-Z]+\s(\*|([0-7]|(SUN|MON|TUE|WED|THU|FRI|SAT))(L?|#[1-5]))([/\,\-]([0-7]|(SUN|MON|TUE|WED|THU|FRI|SAT))+)*(\s[\*,/\-0-9]*)?$";

	/**
	 * Useless constructor, but if not present PHP 7.4.0/7.4.1 is crashing :( (N°2329)
	 *
	 * @see https://www.php.net/manual/fr/language.oop5.decon.php states that child constructor can be ommited
	 *
	 * @param string $sCode
	 * @param array $aParams
	 *
	 * @throws \Exception
	 * @noinspection SenselessProxyMethodInspection
	 */
	public function __construct($sCode, $aParams)
	{
		parent::__construct($sCode, $aParams);
	}

	public function GetValidationPattern()
	{
		return self::VALIDATION_PATTERN;
	}

	public function GetAsHTML($sValue, $oHostObject = null, $bLocalize = true)
	{
		if (!$bLocalize)
		{
			return AttributeCronExpressionHelper::ToHumanText($sValue);
		}

		return AttributeCronExpressionHelper::ToHumanText($sValue, Dict::GetUserLanguage());
	}

//	public function GetAsPlainText($sValue, $oHostObj = null)
//	{
//		return parent::GetAsHTML($sValue, $oHostObj);
//	}

//	public function GetEditValue($sValue, $oHostObj = null)
//	{
//		return (string)parent::GetAsHTML($sValue, $oHostObj);
//	}
}
