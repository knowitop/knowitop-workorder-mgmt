<?php


namespace Knowitop\iTop\Extension\WorkSchedule\Helper;

use Dict;
use Knowitop\iTop\Extension\WorkSchedule\ModuleConfig;
use Knowitop\iTop\Extension\WorkSchedule\Thirdparty\arnapou\jqcron\Cron;
use WebPage;

class AttributeCronExpressionHelper extends Cron
{
	public function __construct($cron = null)
	{
		parent::__construct($cron);
		$this->texts['user_lang'] = static::GetUserLang();
	}

	protected static function GetUserLang(bool $bForWidget = false): array
	{
		$sDictCode = 'Class:AttributeCronExpressionHelper:HumanText:';
		$aLang = array(
			'empty'       => Dict::S($sDictCode.'empty'),
			'name_minute' => Dict::S($sDictCode.'name_minute'),
			'name_hour'   => Dict::S($sDictCode.'name_hour'),
			'name_day'    => Dict::S($sDictCode.'name_day'),
			'name_week'   => Dict::S($sDictCode.'name_week'),
			'name_month'  => Dict::S($sDictCode.'name_month'),
			'name_year'   => Dict::S($sDictCode.'name_year'),
			'weekdays'    => array(
				Dict::S($sDictCode."weekdays:monday"),
				Dict::S($sDictCode."weekdays:tuesday"),
				Dict::S($sDictCode."weekdays:wednesday"),
				Dict::S($sDictCode."weekdays:thursday"),
				Dict::S($sDictCode."weekdays:friday"),
				Dict::S($sDictCode."weekdays:saturday"),
				Dict::S($sDictCode."weekdays:sunday"),
			),
			'months'      => array(
				Dict::S($sDictCode.'months:january'),
				Dict::S($sDictCode.'months:february'),
				Dict::S($sDictCode.'months:march'),
				Dict::S($sDictCode.'months:april'),
				Dict::S($sDictCode.'months:may'),
				Dict::S($sDictCode.'months:june'),
				Dict::S($sDictCode.'months:july'),
				Dict::S($sDictCode.'months:august'),
				Dict::S($sDictCode.'months:september'),
				Dict::S($sDictCode.'months:october'),
				Dict::S($sDictCode.'months:november'),
				Dict::S($sDictCode.'months:december'),
			),
		);
		// Replace php placeholder %s with js <br />
		if ($bForWidget) {
			$aLang['text_period'] = self::PrepareForWidget(Dict::S($sDictCode.'text_period'));
			$aLang['text_mins'] = self::PrepareForWidget(Dict::S($sDictCode.'text_mins'));
			$aLang['text_time'] = self::PrepareForWidget(Dict::S($sDictCode.'text_time'));
			$aLang['text_dow'] = self::PrepareForWidget(Dict::S($sDictCode.'text_dow'));
			$aLang['text_month'] = self::PrepareForWidget(Dict::S($sDictCode.'text_month'));
			$aLang['text_dom'] = self::PrepareForWidget(Dict::S($sDictCode.'text_dom'));
		} else {
			$aLang['text_period'] = Dict::S($sDictCode.'text_period');
			$aLang['text_mins'] = Dict::S($sDictCode.'text_mins');
			$aLang['text_time'] = Dict::S($sDictCode.'text_time');
			$aLang['text_dow'] = Dict::S($sDictCode.'text_dow');
			$aLang['text_month'] = Dict::S($sDictCode.'text_month');
			$aLang['text_dom'] = Dict::S($sDictCode.'text_dom');
		}

		return $aLang;
	}

	protected static function PrepareForWidget(string $sValue): string
	{
		return str_replace(["%s", "%02s"], "<br />", $sValue);
	}

	public function GetHumanText($bLocalized = true): string
	{
		if ($bLocalized) {
			$sLang = 'user_lang';
		} else {
			$sLang = 'en';
		}

		return $this->getText($sLang);
	}

	public static function ToHumanText($sPattern, $bLocalized = true): string
	{
		if (ModuleConfig::Get('cron_expression_widget_enabled', true)) {
			$oCron = new static($sPattern);

			return $oCron->GetHumanText($bLocalized);
		}

		return $sPattern;

	}

	public static function DisplayCronWidget(WebPage $oPage, string $sAttCode)
	{
		if (!ModuleConfig::Get('cron_expression_widget_enabled', true)) {
			return;
		}
		static $bAdded = false;
		if (!$bAdded) {
			$oPage->add_linked_script(ModuleConfig::GetAssetsUrl().'arnapou/jqcron/src/jqCron.min.js');
			$oPage->add_linked_stylesheet(ModuleConfig::GetAssetsUrl().'arnapou/jqcron/src/jqCron.min.css');
			$oPage->add_style(".jqCron-selector-list li { word-break: initial !important; }");
			$bAdded = true;
		}
		$aParams = [
			'minutes'        => [0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55],
			'multiple_month' => true,
			'multiple_dom'   => true,
			'multiple_dow'   => true,
			'default_period' => 'month',
			'default_value'  => '00 12 * * 1-5',
			'lang'           => 'user_lang',
			'texts'          => [
				'user_lang' => self::GetUserLang(true),
			],
		];
		$aParams = array_replace($aParams, ModuleConfig::Get('cron_expression_widget_params', []));
		$sParams = json_encode($aParams);
		$oPage->add_ready_script(
			<<<EOF
var cronExpElement = $('#'+oWizardHelper.GetFieldId('$sAttCode')).attr('type', 'hidden');
var cronParams = $sParams;
cronParams.bind_to = cronExpElement;
cronParams.bind_method = {
	set: function (element, value) {
		element.val(value).trigger('change');
	}
};
var cron = cronExpElement.jqCron(cronParams).jqCronGetInstance();

EOF
		);
	}

}