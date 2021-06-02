<?php
namespace Bitrix\Landing\Controller;

use \Bitrix\Landing\Zip;
use \Bitrix\Main\Engine\Controller;

class Site extends Controller
{
	public function getDefaultPreFilters()
	{
		return [];
	}

	/**
	 * Zip export site.
	 * @param int $id Site id.
	 * @return void
	 */
	public function exportAction($id)
	{
		if (Zip\Config::serviceEnabled())
		{
			Zip\Site::export($id);
		}
	}
}