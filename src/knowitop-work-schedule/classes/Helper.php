<?php

namespace Knowitop;

class Helper
{
	public static function GetCurrentModulePath(): string {
		return APPROOT.'env-'.\utils::GetCurrentEnvironment().'/'.\utils::GetCurrentModuleDir(0);
	}

	public static function GetUserLanguageISO639(): string {
		return strtolower(substr(\Dict::GetUserLanguage(), 0, 2));
	}
}