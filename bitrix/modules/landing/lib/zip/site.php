<?php
namespace Bitrix\Landing\Zip;

use \Bitrix\Landing\File;
use \Bitrix\Main\Engine\Response\Zip\Archive;
use \Bitrix\Main\Engine\Response\Zip\ArchiveEntry;

class Site
{
	/**
	 * Enable or not main option.
	 * @param int $id Site id.
	 * @return void
	 */
	public static function export($id)
	{
		$id = intval($id);
		if (Config::serviceEnabled())
		{
			// export in tmp file
			$tmpDir = \CTempFile::getDirectoryName(
				1, 'landing_site_' . $id
			);
			$jsonFile = $tmpDir . 'site_' . $id . '.json';
			$export = \Bitrix\Landing\Site::fullExport(
				$id,
				['edit_mode' => 'Y']
			);
			\Bitrix\Main\IO\File::putFileContents(
				$jsonFile,
				\CUtil::phpToJSObject($export)
			);

			// gets file ids from export
			$files = File::getFilesFromSite($id);
			foreach ($export['items'] as $landing)
			{
				$files = array_merge($files, File::getFilesFromLanding(
					$landing['old_id']
				));
				if (!isset($landing['items']))
				{
					continue;
				}
				foreach ($landing['items'] as $block)
				{
					$files = array_merge($files, File::getFilesFromBlock(
						$block['old_id']
					));
				}
				unset($block);
			}
			$files = array_unique($files);

			// flush zip to client
			$zip = new Archive('site_' . $id . '.zip');
			$zip->addEntry(
				ArchiveEntry::createFromFilePath($jsonFile)
			);
			if ($files)
			{
				foreach ($files as $fid)
				{
					$zip->addEntry(
						ArchiveEntry::createFromFileId($fid, 'landing')
					);
				}
			}
			unset($tmpDir, $jsonFile, $files, $export, $landing);

			$zip->send();
			unset($zip);
		}
	}
}