<?php
namespace Bitrix\Catalog;
use \Bitrix\Main\SystemException;

class ExportOfferCreator
{
	public static function getOfferObject(array $offerParams)
	{
		if(!isset($offerParams["IBLOCK_ID"]) || intval($offerParams["IBLOCK_ID"]) <= 0)
			throw new SystemException("Incorrect iBlock ID  (".__CLASS__."::".__METHOD__.")");

		$arCatalog = \CCatalog::GetByIDExt($offerParams["IBLOCK_ID"]);

		if (empty($arCatalog))
			throw new SystemException("IBlock is not catalog. (".__CLASS__."::".__METHOD__.")");

		$catalogType = $arCatalog["CATALOG_TYPE"];
		$catalogTypes = \CCatalogSku::GetCatalogTypes();

		if(!in_array($catalogType, $catalogTypes))
			throw new SystemException("Unknown type of catalog (".__CLASS__."::".__METHOD__.")");

		$result = array();

		switch($catalogType)
		{
			case \CCatalogSku::TYPE_CATALOG:
			case \CCatalogSku::TYPE_OFFERS:
				$result = new ExportOffer($catalogType, $offerParams);
				break;

			case \CCatalogSku::TYPE_PRODUCT:
			case \CCatalogSku::TYPE_FULL:
				$result = new ExportOfferSKU($catalogType, $offerParams);
				break;
		}

		return $result;
	}
} 