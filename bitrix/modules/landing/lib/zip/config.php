<?php
namespace Bitrix\Landing\Zip;

use \Bitrix\Landing\Manager;
use \Bitrix\Main\ModuleManager;

class Config
{
	/**
	 * Export path.
	 */
	const EXPORT_PATH = '/bitrix/services/main/ajax.php?action=landing.site.export&id=#id#';

	/**
	 * Enable or not main option.
	 * @return bool
	 */
	public static function serviceEnabled()
	{
		if (ModuleManager::isModuleInstalled('bitrix24'))
		{
			return true;
		}
		else
		{
			return Manager::getOption('enable_mod_zip', 'N') == 'Y';
		}
	}

	/**
	 * Gets export site path.
	 * @return string
	 */
	public static function getExportPath()
	{
		return self::EXPORT_PATH;
	}
}