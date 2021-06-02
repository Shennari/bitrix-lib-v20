<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2013 Bitrix
 */

use Bitrix\Main\Session\Legacy\HealerEarlySessionStart;

require_once(mb_substr(__FILE__, 0, mb_strlen(__FILE__) - mb_strlen("/include.php"))."/bx_root.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/start.php");

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/virtual_io.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/virtual_file.php");

$application = \Bitrix\Main\Application::getInstance();
$application->initializeExtendedKernel(array(
	"get" => $_GET,
	"post" => $_POST,
	"files" => $_FILES,
	"cookie" => $_COOKIE,
	"server" => $_SERVER,
	"env" => $_ENV
));

//define global application object
$GLOBALS["APPLICATION"] = new CMain;

if(defined("SITE_ID"))
	define("LANG", SITE_ID);

if(defined("LANG"))
{
	if(defined("ADMIN_SECTION") && ADMIN_SECTION===true)
		$db_lang = CLangAdmin::GetByID(LANG);
	else
		$db_lang = CLang::GetByID(LANG);

	$arLang = $db_lang->Fetch();

	if(!$arLang)
	{
		throw new \Bitrix\Main\SystemException("Incorrect site: ".LANG.".");
	}
}
else
{
	$arLang = $GLOBALS["APPLICATION"]->GetLang();
	define("LANG", $arLang["LID"]);
}

if($arLang["CULTURE_ID"] == '')
{
	throw new \Bitrix\Main\SystemException("Culture not found, or there are no active sites or languages.");
}

$lang = $arLang["LID"];
if (!defined("SITE_ID"))
	define("SITE_ID", $arLang["LID"]);
define("SITE_DIR", $arLang["DIR"]);
define("SITE_SERVER_NAME", $arLang["SERVER_NAME"]);
define("SITE_CHARSET", $arLang["CHARSET"]);
define("FORMAT_DATE", $arLang["FORMAT_DATE"]);
define("FORMAT_DATETIME", $arLang["FORMAT_DATETIME"]);
define("LANG_DIR", $arLang["DIR"]);
define("LANG_CHARSET", $arLang["CHARSET"]);
define("LANG_ADMIN_LID", $arLang["LANGUAGE_ID"]);
define("LANGUAGE_ID", $arLang["LANGUAGE_ID"]);

$culture = \Bitrix\Main\Localization\CultureTable::getByPrimary($arLang["CULTURE_ID"], ["cache" => ["ttl" => CACHED_b_lang]])->fetchObject();

$context = $application->getContext();
$context->setLanguage(LANGUAGE_ID);
$context->setCulture($culture);

$request = $context->getRequest();
if (!$request->isAdminSection())
{
	$context->setSite(SITE_ID);
}

$application->start();

$GLOBALS["APPLICATION"]->reinitPath();

if (!defined("POST_FORM_ACTION_URI"))
{
	define("POST_FORM_ACTION_URI", htmlspecialcharsbx(GetRequestUri()));
}

$GLOBALS["MESS"] = array();
$GLOBALS["ALL_LANG_FILES"] = array();
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/tools.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/database.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/main.php");
IncludeModuleLangFile(__FILE__);

error_reporting(COption::GetOptionInt("main", "error_reporting", E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR|E_PARSE) & ~E_STRICT & ~E_DEPRECATED);

if(!defined("BX_COMP_MANAGED_CACHE") && COption::GetOptionString("main", "component_managed_cache_on", "Y") <> "N")
{
	define("BX_COMP_MANAGED_CACHE", true);
}

require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/filter_tools.php");
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/ajax_tools.php");

/*ZDUyZmZMjU4NWUyMWQwNTMzMTA4MGU5ZDI0NTM3YjMyNDY3MjY=*/$GLOBALS['_____211713037']= array(base64_decode('R2'.'V0TW9'.'k'.'dWxlRXZlbnRz'),base64_decode('RXhlY3V0ZU1'.'vZHV'.'sZUV2'.'ZW50'.'RX'.'g='));$GLOBALS['____613578050']= array(base64_decode('ZG'.'Vm'.'aW5l'),base64_decode(''.'c3Ry'.'bGVu'),base64_decode('YmFzZ'.'T'.'Y0X2RlY'.'29k'.'ZQ=='),base64_decode(''.'dW'.'5zZXJpYWxpe'.'mU='),base64_decode('aXN'.'fYXJyYXk='),base64_decode('Y291bnQ='),base64_decode('aW5f'.'YX'.'J'.'yYXk='),base64_decode('c2VyaWFs'.'aX'.'pl'),base64_decode('YmFzZTY0X2VuY29kZQ=='),base64_decode(''.'c3R'.'y'.'bGVu'),base64_decode('YXJyYX'.'lfa'.'2V5X2V4'.'aXN0cw=='),base64_decode('Y'.'XJy'.'YXl'.'fa2V5'.'X2'.'V4aXN0cw=='),base64_decode(''.'bW'.'t0aW'.'1l'),base64_decode('ZGF'.'0'.'ZQ=='),base64_decode('ZGF'.'0Z'.'Q'.'=='),base64_decode('YXJ'.'yYXlfa2V5X2'.'V4aX'.'N0cw'.'=='),base64_decode('c'.'3RybGVu'),base64_decode('YXJyY'.'Xl'.'fa2V'.'5X2V'.'4aXN0'.'cw=='),base64_decode('c3R'.'ybG'.'V'.'u'),base64_decode('YX'.'JyY'.'Xlfa2'.'V5'.'X2V4'.'aX'.'N'.'0cw'.'='.'='),base64_decode('Y'.'X'.'JyY'.'Xl'.'f'.'a2V5'.'X2V4aXN0cw=='),base64_decode('bWt0'.'aW1l'),base64_decode('ZG'.'F0'.'ZQ=='),base64_decode('ZGF'.'0ZQ'.'=='),base64_decode('bWV0a'.'G'.'9k'.'X2V'.'4'.'aXN0'.'cw=='),base64_decode('Y2Fsb'.'F91'.'c2VyX2Z1bmNfYXJyYX'.'k='),base64_decode('c3'.'RybGVu'),base64_decode('YX'.'J'.'yYXlf'.'a2'.'V5'.'X2V4'.'aXN'.'0'.'cw=='),base64_decode('Y'.'XJy'.'Y'.'Xlfa2V5X2V4aXN'.'0c'.'w='.'='),base64_decode('c2'.'Vya'.'WF'.'saX'.'pl'),base64_decode('YmFzZTY0X2VuY2'.'9kZ'.'Q=='),base64_decode('c3RybGVu'),base64_decode('YXJyYXlfa2V5X2V4'.'aXN0cw=='),base64_decode('YXJ'.'yYXlfa2V5X2V4'.'aXN'.'0'.'c'.'w'.'=='),base64_decode(''.'Y'.'XJyYXlfa2'.'V5X2V4aXN0cw=='),base64_decode('a'.'XNfYXJy'.'YXk'.'='),base64_decode('YXJyYXlf'.'a2V5'.'X2V4aXN0'.'cw=='),base64_decode('c'.'2V'.'yaWF'.'saX'.'p'.'l'),base64_decode(''.'YmFz'.'ZTY0X2'.'VuY2'.'9kZQ'.'='.'='),base64_decode(''.'YXJyY'.'Xlfa2V'.'5X2V4aX'.'N0c'.'w=='),base64_decode('Y'.'XJyYXlfa2V5X2V4a'.'X'.'N0cw=='),base64_decode('c2'.'VyaW'.'Fsa'.'Xpl'),base64_decode(''.'YmFzZT'.'Y0X2V'.'uY29kZQ='.'='),base64_decode(''.'aXNf'.'YXJyYX'.'k='),base64_decode('aX'.'NfYXJ'.'y'.'Y'.'Xk'.'='),base64_decode('aW5fYXJyYX'.'k='),base64_decode('YXJyYXlfa2V5X2'.'V4aXN0'.'c'.'w'.'=='),base64_decode('aW5fYXJyYXk='),base64_decode('b'.'Wt0aW1l'),base64_decode('ZG'.'F'.'0Z'.'Q=='),base64_decode('ZGF0ZQ=='),base64_decode('ZGF'.'0ZQ=='),base64_decode('bW'.'t0a'.'W1l'),base64_decode('Z'.'G'.'F0ZQ=='),base64_decode('ZGF0ZQ=='),base64_decode('aW5fYXJyYXk='),base64_decode('YXJyY'.'Xlfa2V5X2V4aXN0cw=='),base64_decode('Y'.'XJyY'.'Xlfa2V5X'.'2V'.'4aXN'.'0c'.'w=='),base64_decode('c'.'2'.'V'.'y'.'aWFsaXpl'),base64_decode(''.'Ym'.'Fz'.'ZTY0X2VuY2'.'9k'.'ZQ'.'='.'='),base64_decode('YXJyY'.'X'.'lfa'.'2V5X2V4'.'aXN0cw='.'='),base64_decode(''.'a'.'W50dmF'.'s'),base64_decode('d'.'Glt'.'ZQ'.'=='),base64_decode(''.'Y'.'XJy'.'Y'.'Xlfa'.'2V5'.'X2V4aXN'.'0cw=='),base64_decode('ZmlsZV9leGlzdHM='),base64_decode('c3RyX3'.'JlcGx'.'hY'.'2'.'U='),base64_decode('Y2xhc3'.'N'.'fZXhpc3Rz'),base64_decode('ZGVma'.'W'.'5'.'l'));if(!function_exists(__NAMESPACE__.'\\___1809889997')){function ___1809889997($_1803246405){static $_1607319063= false; if($_1607319063 == false) $_1607319063=array('SU5U'.'UkFO'.'R'.'V'.'RfRURJ'.'V'.'ElPTg='.'=','WQ==','b'.'WFpbg==','fmNwZl9tYXBf'.'dmFs'.'dWU=','','ZQ==','Zg==','ZQ==','Rg==','WA==','Zg==','bW'.'Fpb'.'g==','fm'.'NwZl9tYXBfdm'.'F'.'sd'.'WU=','U'.'G9ydGFs','Rg==','ZQ==','ZQ==','WA='.'=',''.'Rg='.'=','RA='.'=','RA==','bQ==','ZA'.'==','WQ==',''.'Z'.'g==','Z'.'g==','Z'.'g='.'=','Zg='.'=','UG9'.'ydGFs',''.'Rg==','Z'.'Q==','Z'.'Q'.'='.'=','W'.'A==','R'.'g==','RA'.'==','RA='.'=',''.'bQ==','ZA='.'=','W'.'Q='.'=',''.'bWFp'.'b'.'g'.'==','T24=','U2V0'.'dGluZ3NDaGFuZ2U=','Zg'.'==','Zg==',''.'Zg==','Zg==','bWFpbg==','f'.'mNwZl9tYX'.'BfdmFs'.'dWU'.'=','ZQ==',''.'ZQ==','ZQ'.'==','RA==','ZQ'.'==','Z'.'Q'.'==','Zg='.'=','Zg='.'=',''.'Zg'.'==',''.'ZQ'.'==','bWFpbg==','fmN'.'w'.'Zl9t'.'YXBfdmFsdWU=','ZQ='.'=','Zg='.'=','Zg==',''.'Z'.'g==','Z'.'g==','b'.'WF'.'pbg==','fmNwZl9'.'tYXB'.'fdmFsdWU=','ZQ='.'=','Zg==','UG'.'9ydGFs','UG9ydGF'.'s','ZQ==',''.'ZQ==','UG9y'.'d'.'GFs','Rg='.'=','WA='.'=','Rg==','RA==','Z'.'Q'.'='.'=','Z'.'Q==','RA==',''.'bQ'.'==','ZA==','WQ'.'==','ZQ==','W'.'A='.'=','ZQ='.'=',''.'Rg==','ZQ==','RA'.'='.'=','Zg==','ZQ'.'==',''.'RA==',''.'ZQ==','bQ==','ZA==','WQ'.'==','Zg'.'==','Zg'.'==',''.'Z'.'g==','Zg='.'=',''.'Zg='.'=','Zg='.'=','Zg'.'==','Zg'.'==',''.'bWFpbg='.'=','f'.'mNwZl'.'9tYXBfdm'.'F'.'sdW'.'U=',''.'Z'.'Q='.'=','ZQ='.'=','UG9ydGFs',''.'Rg'.'==','WA==',''.'VFl'.'QRQ==','R'.'EFUR'.'Q==','Rk'.'VBVFVSRVM=','R'.'VhQSVJ'.'FRA='.'=',''.'VFl'.'QR'.'Q'.'==','RA==','V'.'FJZX0RBWVNfQ09V'.'Tl'.'Q=','REFURQ='.'=','VFJ'.'Z'.'X0RBWVN'.'fQ09V'.'TlQ=','RVh'.'QSV'.'JFRA='.'=','RkVB'.'V'.'F'.'VSRVM=','Zg==',''.'Zg==','RE9DVU1FTlRfUk9P'.'V'.'A='.'=','L2JpdHJp'.'eC9tb'.'2'.'R1bGVzLw==','L2l'.'u'.'c3RhbGwvaW5kZXgucG'.'hw','Lg==','Xw='.'=',''.'c2VhcmN'.'o','Tg==','','',''.'QU'.'N'.'USVZ'.'F','WQ==','c'.'29'.'jaWFs'.'bm'.'V0d29yaw'.'='.'=',''.'YWxsb'.'3'.'dfZ'.'n'.'JpZ'.'Wxkc'.'w'.'='.'=','W'.'Q==','SUQ'.'=','c29ja'.'WFs'.'b'.'mV0'.'d29y'.'aw==','YW'.'xsb3d'.'fZnJ'.'pZWx'.'k'.'cw='.'=','SUQ=','c29jaWFsbm'.'V0d29yaw==','Y'.'Wxsb3df'.'ZnJpZW'.'xkcw==','Tg==','','','QUN'.'US'.'VZ'.'F','WQ==','c29jaWF'.'sbmV0d29'.'yaw'.'==','YWx'.'sb3dfbWljcm9'.'ibG9nX3V'.'zZ'.'XI=','WQ='.'=','SUQ=','c29j'.'aWFsbmV0d29'.'yaw='.'=','YWxs'.'b'.'3'.'dfbWljcm'.'9ibG9nX'.'3'.'VzZ'.'X'.'I'.'=','SUQ=','c29jaWFsb'.'mV'.'0d29y'.'aw='.'=','YW'.'xsb3d'.'fbW'.'ljcm'.'9ib'.'G9nX3VzZXI'.'=',''.'c29jaWF'.'s'.'bmV0d2'.'9yaw==','Y'.'Wxsb3d'.'fbWl'.'jcm'.'9'.'ib'.'G9'.'nX'.'2dy'.'b3'.'Vw','WQ==','SUQ=',''.'c29'.'jaW'.'Fs'.'bmV0d29yaw==','YWxsb3d'.'fbWljcm9ib'.'G9nX2dyb3Vw','SUQ=',''.'c29ja'.'WFsb'.'mV0'.'d29'.'yaw'.'==','Y'.'W'.'xs'.'b'.'3'.'dfb'.'W'.'ljcm9ibG9nX2dyb3Vw','Tg'.'==','','','QU'.'NUSVZF',''.'WQ==','c2'.'9jaW'.'Fsb'.'mV0'.'d2'.'9y'.'aw==','YWxs'.'b3d'.'f'.'Zml'.'sZ'.'XNfdXNlcg==','WQ==','SUQ=','c2'.'9j'.'aWF'.'sbmV0d29yaw'.'==','YWxsb3dfZmlsZXNfdXNl'.'c'.'g'.'==','S'.'UQ=','c29jaWF'.'sb'.'m'.'V0d29y'.'aw==','YWxsb'.'3df'.'ZmlsZXNfdXNlcg==','Tg==','','','QU'.'NUSVZF','WQ='.'=',''.'c'.'29'.'ja'.'WFsbmV'.'0d'.'29yaw'.'==',''.'YW'.'xsb3dfYmxvZ1'.'91'.'c2'.'Vy','W'.'Q==','SUQ=','c'.'29j'.'aW'.'Fsb'.'m'.'V0'.'d'.'29yaw='.'=','YWxsb3dfYmx'.'vZ19'.'1c2Vy','S'.'U'.'Q=','c'.'29jaWFsbmV0d'.'29yaw==','YWx'.'sb'.'3dfY'.'mx'.'vZ191'.'c2V'.'y',''.'Tg==','','','Q'.'UNUS'.'VZF','WQ==','c29'.'jaWF'.'s'.'b'.'m'.'V0d'.'29yaw'.'==','YWx'.'sb3'.'dfcGhvd'.'G'.'9f'.'dX'.'Nlcg==',''.'WQ'.'==',''.'SUQ=','c29j'.'aW'.'Fs'.'bmV0d29yaw==',''.'YWxsb3d'.'fc'.'GhvdG'.'9fdXNl'.'cg==','SU'.'Q=','c29jaWFsbmV0d29ya'.'w==','YWxs'.'b3dfcGh'.'v'.'dG'.'9fdXNlcg'.'==','Tg==','','','QUN'.'US'.'V'.'ZF','WQ==','c29'.'j'.'aWF'.'sb'.'mV0d29yaw'.'==','YWxsb'.'3'.'dfZm9'.'y'.'d'.'W1fdXNlcg==',''.'WQ='.'=','S'.'UQ'.'=','c29'.'jaWFs'.'bmV0'.'d'.'29'.'y'.'aw==','Y'.'Wxsb3dfZm9ydW'.'1fdXN'.'l'.'c'.'g==',''.'SUQ=','c'.'29jaWFsbmV0'.'d29yaw'.'==','YWx'.'s'.'b3dfZ'.'m9'.'y'.'dW'.'1fdX'.'Nlcg'.'==','Tg==','','','QUNUSVZF','WQ==','c'.'29jaWF'.'s'.'bm'.'V0d29'.'yaw==','YWxs'.'b'.'3dfdG'.'F'.'za3NfdXNlcg'.'==','WQ='.'=','SU'.'Q=','c29j'.'aWFsbmV0d29'.'yaw==',''.'YWxsb3d'.'fdGFza3'.'Nfd'.'X'.'Nlcg==','S'.'U'.'Q=','c29ja'.'WFsb'.'m'.'V0d2'.'9yaw==','YWxsb3'.'df'.'dGFza'.'3NfdXNl'.'cg==','c2'.'9jaWFsbmV'.'0d29'.'y'.'aw==','Y'.'W'.'x'.'sb3d'.'fd'.'GF'.'za3NfZ3'.'Jv'.'dXA=','WQ==','SUQ'.'=','c29jaW'.'FsbmV0d29yaw='.'=','YWxsb3d'.'fdG'.'Fza3NfZ3'.'JvdXA=',''.'SUQ=','c2'.'9'.'j'.'aWFsbmV0d29ya'.'w='.'=','YWxsb3dfdG'.'F'.'za3NfZ'.'3JvdX'.'A=','dGFza3M'.'=','T'.'g'.'==','','',''.'QU'.'NUSVZF','WQ'.'==','c'.'29'.'j'.'aWFs'.'b'.'mV0d'.'29yaw==','YWxsb3dfY2'.'Fs'.'ZW5k'.'Y'.'XJfdXNl'.'cg'.'==','W'.'Q='.'=','SU'.'Q'.'=','c29j'.'aWFsbm'.'V0d2'.'9yaw==',''.'Y'.'Wxs'.'b3dfY2F'.'sZW5k'.'YXJfd'.'XN'.'l'.'c'.'g==','SUQ=',''.'c29jaWFs'.'bmV'.'0d29yaw==','YW'.'xs'.'b'.'3'.'df'.'Y2'.'FsZW'.'5kYXJ'.'fdXNl'.'c'.'g'.'==','c'.'29ja'.'WFsbmV0d29'.'yaw='.'=','YW'.'xsb3d'.'fY2'.'F'.'sZW5k'.'YXJfZ3J'.'vdXA=',''.'WQ==',''.'SUQ=','c29jaWF'.'sbmV0d29yaw==','YWx'.'sb3d'.'f'.'Y2FsZW5kYXJfZ3'.'JvdXA'.'=','SU'.'Q=',''.'c'.'29j'.'aWFsbmV0d2'.'9y'.'aw='.'=','YW'.'xsb'.'3df'.'Y2FsZW5kYXJfZ'.'3'.'JvdXA'.'=',''.'QUNU'.'SVZF',''.'WQ'.'==','Tg==','ZX'.'h0cmFuZXQ=',''.'aWJ'.'sb2N'.'r',''.'T25BZ'.'n'.'Rlckl'.'C'.'b'.'G9ja0VsZW'.'1l'.'b'.'n'.'RVcGRhdGU=','aW50cmFuZ'.'XQ=','Q'.'0'.'ludHJh'.'b'.'mV0RXZ'.'lb'.'nRI'.'YW'.'5kbGVycw='.'=','U1B'.'SZWdp'.'c3Rlc'.'l'.'V'.'wZ'.'GF0'.'ZW'.'RJd'.'G'.'V'.'t','Q0ludHJ'.'hbmV0U2hh'.'cm'.'Vwb'.'2lud'.'Do'.'6Q'.'WdlbnR'.'M'.'aXN0cygpOw==','a'.'W'.'50c'.'mFuZX'.'Q=','Tg==','Q0lud'.'HJhbmV0U2hhcm'.'V'.'wb2lu'.'dDo6QWdlbnRR'.'dWV1ZSgpOw='.'=','aW50'.'cmFuZXQ'.'=','Tg'.'==','Q'.'0'.'lud'.'HJhbm'.'V0'.'U2h'.'hc'.'mVwb2lu'.'dD'.'o6QWd'.'l'.'b'.'nRVcGR'.'hdGUoKTs=','aW'.'5'.'0'.'cmF'.'u'.'ZX'.'Q'.'=','Tg==','aWJsb2'.'N'.'r',''.'T2'.'5BZ'.'nRlc'.'k'.'lCbG9ja0VsZ'.'W'.'1lbnRBZGQ=',''.'aW50cmFuZXQ=','Q0ludH'.'JhbmV0RXZ'.'lbn'.'RIYW5kbGVycw'.'==','U1BSZWdpc3RlclVwZGF0Z'.'WRJdGV'.'t','aW'.'J'.'sb2N'.'r','T25BZnRlcklCbG9ja0Vs'.'ZW1lbnRVcG'.'Rh'.'dGU=','aW50c'.'mF'.'uZX'.'Q=','Q0ludHJhbm'.'V0RXZ'.'lbnRIYW'.'5kbGVycw'.'==',''.'U'.'1BSZWdpc3RlclVwZ'.'GF0'.'ZWRJ'.'dG'.'Vt','Q'.'0ludHJhbmV0U2h'.'hcm'.'Vwb'.'2ludDo'.'6Q'.'W'.'d'.'lbn'.'RMaXN0cygpOw==','aW50'.'cmFuZ'.'XQ=','Q0ludHJ'.'hbmV0U2'.'h'.'h'.'c'.'m'.'Vwb2ludD'.'o'.'6Q'.'Wd'.'lbn'.'RRdWV1Z'.'S'.'gpOw==','aW50cmFuZXQ=','Q0lud'.'H'.'Jhb'.'m'.'V0'.'U2hhcmVwb'.'2lu'.'dDo6Q'.'WdlbnR'.'VcGRhdG'.'UoK'.'Ts=','a'.'W50cmFuZXQ=','Y3Jt','bWFp'.'bg==','T25CZWZvcmVQcm9sb2c=',''.'b'.'WFpbg==','Q1'.'d'.'p'.'emFy'.'Z'.'FNvbF'.'Bh'.'b'.'mVsS'.'W50cm'.'FuZXQ=',''.'U2'.'hvd1Bhbm'.'V'.'s','L2'.'1'.'vZHV'.'sZXMva'.'W5'.'0c'.'mFuZX'.'QvcGFuZW'.'x'.'fYnV0dG'.'9uLnB'.'ocA==',''.'R'.'U5DT0RF','WQ'.'==');return base64_decode($_1607319063[$_1803246405]);}};$GLOBALS['____613578050'][0](___1809889997(0), ___1809889997(1));class CBXFeatures{ private static $_1369707809= 30; private static $_387331251= array( "Portal" => array( "CompanyCalendar", "CompanyPhoto", "CompanyVideo", "CompanyCareer", "StaffChanges", "StaffAbsence", "CommonDocuments", "MeetingRoomBookingSystem", "Wiki", "Learning", "Vote", "WebLink", "Subscribe", "Friends", "PersonalFiles", "PersonalBlog", "PersonalPhoto", "PersonalForum", "Blog", "Forum", "Gallery", "Board", "MicroBlog", "WebMessenger",), "Communications" => array( "Tasks", "Calendar", "Workgroups", "Jabber", "VideoConference", "Extranet", "SMTP", "Requests", "DAV", "intranet_sharepoint", "timeman", "Idea", "Meeting", "EventList", "Salary", "XDImport",), "Enterprise" => array( "BizProc", "Lists", "Support", "Analytics", "crm", "Controller", "LdapUnlimitedUsers",), "Holding" => array( "Cluster", "MultiSites",),); private static $_1771529301= false; private static $_819535625= false; private static function __2143714365(){ if(self::$_1771529301 == false){ self::$_1771529301= array(); foreach(self::$_387331251 as $_24202136 => $_447022787){ foreach($_447022787 as $_1497131485) self::$_1771529301[$_1497131485]= $_24202136;}} if(self::$_819535625 == false){ self::$_819535625= array(); $_1413852404= COption::GetOptionString(___1809889997(2), ___1809889997(3), ___1809889997(4)); if($GLOBALS['____613578050'][1]($_1413852404)>(237*2-474)){ $_1413852404= $GLOBALS['____613578050'][2]($_1413852404); self::$_819535625= $GLOBALS['____613578050'][3]($_1413852404); if(!$GLOBALS['____613578050'][4](self::$_819535625)) self::$_819535625= array();} if($GLOBALS['____613578050'][5](self::$_819535625) <=(834-2*417)) self::$_819535625= array(___1809889997(5) => array(), ___1809889997(6) => array());}} public static function InitiateEditionsSettings($_903741162){ self::__2143714365(); $_1073252303= array(); foreach(self::$_387331251 as $_24202136 => $_447022787){ $_212926047= $GLOBALS['____613578050'][6]($_24202136, $_903741162); self::$_819535625[___1809889997(7)][$_24202136]=($_212926047? array(___1809889997(8)): array(___1809889997(9))); foreach($_447022787 as $_1497131485){ self::$_819535625[___1809889997(10)][$_1497131485]= $_212926047; if(!$_212926047) $_1073252303[]= array($_1497131485, false);}} $_1136961833= $GLOBALS['____613578050'][7](self::$_819535625); $_1136961833= $GLOBALS['____613578050'][8]($_1136961833); COption::SetOptionString(___1809889997(11), ___1809889997(12), $_1136961833); foreach($_1073252303 as $_1125183966) self::__106948123($_1125183966[(129*2-258)], $_1125183966[round(0+1)]);} public static function IsFeatureEnabled($_1497131485){ if($GLOBALS['____613578050'][9]($_1497131485) <= 0) return true; self::__2143714365(); if(!$GLOBALS['____613578050'][10]($_1497131485, self::$_1771529301)) return true; if(self::$_1771529301[$_1497131485] == ___1809889997(13)) $_2146868310= array(___1809889997(14)); elseif($GLOBALS['____613578050'][11](self::$_1771529301[$_1497131485], self::$_819535625[___1809889997(15)])) $_2146868310= self::$_819535625[___1809889997(16)][self::$_1771529301[$_1497131485]]; else $_2146868310= array(___1809889997(17)); if($_2146868310[min(100,0,33.333333333333)] != ___1809889997(18) && $_2146868310[(1340/2-670)] != ___1809889997(19)){ return false;} elseif($_2146868310[(950-2*475)] == ___1809889997(20)){ if($_2146868310[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]< $GLOBALS['____613578050'][12]((1108/2-554),(164*2-328),(186*2-372), Date(___1809889997(21)), $GLOBALS['____613578050'][13](___1809889997(22))- self::$_1369707809, $GLOBALS['____613578050'][14](___1809889997(23)))){ if(!isset($_2146868310[round(0+1+1)]) ||!$_2146868310[round(0+2)]) self::__1373611875(self::$_1771529301[$_1497131485]); return false;}} return!$GLOBALS['____613578050'][15]($_1497131485, self::$_819535625[___1809889997(24)]) || self::$_819535625[___1809889997(25)][$_1497131485];} public static function IsFeatureInstalled($_1497131485){ if($GLOBALS['____613578050'][16]($_1497131485) <= 0) return true; self::__2143714365(); return($GLOBALS['____613578050'][17]($_1497131485, self::$_819535625[___1809889997(26)]) && self::$_819535625[___1809889997(27)][$_1497131485]);} public static function IsFeatureEditable($_1497131485){ if($GLOBALS['____613578050'][18]($_1497131485) <= 0) return true; self::__2143714365(); if(!$GLOBALS['____613578050'][19]($_1497131485, self::$_1771529301)) return true; if(self::$_1771529301[$_1497131485] == ___1809889997(28)) $_2146868310= array(___1809889997(29)); elseif($GLOBALS['____613578050'][20](self::$_1771529301[$_1497131485], self::$_819535625[___1809889997(30)])) $_2146868310= self::$_819535625[___1809889997(31)][self::$_1771529301[$_1497131485]]; else $_2146868310= array(___1809889997(32)); if($_2146868310[(1084/2-542)] != ___1809889997(33) && $_2146868310[(1048/2-524)] != ___1809889997(34)){ return false;} elseif($_2146868310[(932-2*466)] == ___1809889997(35)){ if($_2146868310[round(0+0.25+0.25+0.25+0.25)]< $GLOBALS['____613578050'][21](min(210,0,70),(1304/2-652),(826-2*413), Date(___1809889997(36)), $GLOBALS['____613578050'][22](___1809889997(37))- self::$_1369707809, $GLOBALS['____613578050'][23](___1809889997(38)))){ if(!isset($_2146868310[round(0+0.66666666666667+0.66666666666667+0.66666666666667)]) ||!$_2146868310[round(0+1+1)]) self::__1373611875(self::$_1771529301[$_1497131485]); return false;}} return true;} private static function __106948123($_1497131485, $_17391222){ if($GLOBALS['____613578050'][24]("CBXFeatures", "On".$_1497131485."SettingsChange")) $GLOBALS['____613578050'][25](array("CBXFeatures", "On".$_1497131485."SettingsChange"), array($_1497131485, $_17391222)); $_158894931= $GLOBALS['_____211713037'][0](___1809889997(39), ___1809889997(40).$_1497131485.___1809889997(41)); while($_1857494628= $_158894931->Fetch()) $GLOBALS['_____211713037'][1]($_1857494628, array($_1497131485, $_17391222));} public static function SetFeatureEnabled($_1497131485, $_17391222= true, $_1748718230= true){ if($GLOBALS['____613578050'][26]($_1497131485) <= 0) return; if(!self::IsFeatureEditable($_1497131485)) $_17391222= false; $_17391222=($_17391222? true: false); self::__2143714365(); $_1802314143=(!$GLOBALS['____613578050'][27]($_1497131485, self::$_819535625[___1809889997(42)]) && $_17391222 || $GLOBALS['____613578050'][28]($_1497131485, self::$_819535625[___1809889997(43)]) && $_17391222 != self::$_819535625[___1809889997(44)][$_1497131485]); self::$_819535625[___1809889997(45)][$_1497131485]= $_17391222; $_1136961833= $GLOBALS['____613578050'][29](self::$_819535625); $_1136961833= $GLOBALS['____613578050'][30]($_1136961833); COption::SetOptionString(___1809889997(46), ___1809889997(47), $_1136961833); if($_1802314143 && $_1748718230) self::__106948123($_1497131485, $_17391222);} private static function __1373611875($_24202136){ if($GLOBALS['____613578050'][31]($_24202136) <= 0 || $_24202136 == "Portal") return; self::__2143714365(); if(!$GLOBALS['____613578050'][32]($_24202136, self::$_819535625[___1809889997(48)]) || $GLOBALS['____613578050'][33]($_24202136, self::$_819535625[___1809889997(49)]) && self::$_819535625[___1809889997(50)][$_24202136][(1056/2-528)] != ___1809889997(51)) return; if(isset(self::$_819535625[___1809889997(52)][$_24202136][round(0+0.4+0.4+0.4+0.4+0.4)]) && self::$_819535625[___1809889997(53)][$_24202136][round(0+0.66666666666667+0.66666666666667+0.66666666666667)]) return; $_1073252303= array(); if($GLOBALS['____613578050'][34]($_24202136, self::$_387331251) && $GLOBALS['____613578050'][35](self::$_387331251[$_24202136])){ foreach(self::$_387331251[$_24202136] as $_1497131485){ if($GLOBALS['____613578050'][36]($_1497131485, self::$_819535625[___1809889997(54)]) && self::$_819535625[___1809889997(55)][$_1497131485]){ self::$_819535625[___1809889997(56)][$_1497131485]= false; $_1073252303[]= array($_1497131485, false);}} self::$_819535625[___1809889997(57)][$_24202136][round(0+0.66666666666667+0.66666666666667+0.66666666666667)]= true;} $_1136961833= $GLOBALS['____613578050'][37](self::$_819535625); $_1136961833= $GLOBALS['____613578050'][38]($_1136961833); COption::SetOptionString(___1809889997(58), ___1809889997(59), $_1136961833); foreach($_1073252303 as $_1125183966) self::__106948123($_1125183966[(194*2-388)], $_1125183966[round(0+0.2+0.2+0.2+0.2+0.2)]);} public static function ModifyFeaturesSettings($_903741162, $_447022787){ self::__2143714365(); foreach($_903741162 as $_24202136 => $_834710705) self::$_819535625[___1809889997(60)][$_24202136]= $_834710705; $_1073252303= array(); foreach($_447022787 as $_1497131485 => $_17391222){ if(!$GLOBALS['____613578050'][39]($_1497131485, self::$_819535625[___1809889997(61)]) && $_17391222 || $GLOBALS['____613578050'][40]($_1497131485, self::$_819535625[___1809889997(62)]) && $_17391222 != self::$_819535625[___1809889997(63)][$_1497131485]) $_1073252303[]= array($_1497131485, $_17391222); self::$_819535625[___1809889997(64)][$_1497131485]= $_17391222;} $_1136961833= $GLOBALS['____613578050'][41](self::$_819535625); $_1136961833= $GLOBALS['____613578050'][42]($_1136961833); COption::SetOptionString(___1809889997(65), ___1809889997(66), $_1136961833); self::$_819535625= false; foreach($_1073252303 as $_1125183966) self::__106948123($_1125183966[(1248/2-624)], $_1125183966[round(0+0.25+0.25+0.25+0.25)]);} public static function SaveFeaturesSettings($_1738124399, $_1309824325){ self::__2143714365(); $_2059077635= array(___1809889997(67) => array(), ___1809889997(68) => array()); if(!$GLOBALS['____613578050'][43]($_1738124399)) $_1738124399= array(); if(!$GLOBALS['____613578050'][44]($_1309824325)) $_1309824325= array(); if(!$GLOBALS['____613578050'][45](___1809889997(69), $_1738124399)) $_1738124399[]= ___1809889997(70); foreach(self::$_387331251 as $_24202136 => $_447022787){ if($GLOBALS['____613578050'][46]($_24202136, self::$_819535625[___1809889997(71)])) $_1028751993= self::$_819535625[___1809889997(72)][$_24202136]; else $_1028751993=($_24202136 == ___1809889997(73))? array(___1809889997(74)): array(___1809889997(75)); if($_1028751993[(139*2-278)] == ___1809889997(76) || $_1028751993[(944-2*472)] == ___1809889997(77)){ $_2059077635[___1809889997(78)][$_24202136]= $_1028751993;} else{ if($GLOBALS['____613578050'][47]($_24202136, $_1738124399)) $_2059077635[___1809889997(79)][$_24202136]= array(___1809889997(80), $GLOBALS['____613578050'][48](min(74,0,24.666666666667),(1276/2-638),(930-2*465), $GLOBALS['____613578050'][49](___1809889997(81)), $GLOBALS['____613578050'][50](___1809889997(82)), $GLOBALS['____613578050'][51](___1809889997(83)))); else $_2059077635[___1809889997(84)][$_24202136]= array(___1809889997(85));}} $_1073252303= array(); foreach(self::$_1771529301 as $_1497131485 => $_24202136){ if($_2059077635[___1809889997(86)][$_24202136][(758-2*379)] != ___1809889997(87) && $_2059077635[___1809889997(88)][$_24202136][(1112/2-556)] != ___1809889997(89)){ $_2059077635[___1809889997(90)][$_1497131485]= false;} else{ if($_2059077635[___1809889997(91)][$_24202136][(930-2*465)] == ___1809889997(92) && $_2059077635[___1809889997(93)][$_24202136][round(0+0.33333333333333+0.33333333333333+0.33333333333333)]< $GLOBALS['____613578050'][52]((1164/2-582), min(126,0,42),(948-2*474), Date(___1809889997(94)), $GLOBALS['____613578050'][53](___1809889997(95))- self::$_1369707809, $GLOBALS['____613578050'][54](___1809889997(96)))) $_2059077635[___1809889997(97)][$_1497131485]= false; else $_2059077635[___1809889997(98)][$_1497131485]= $GLOBALS['____613578050'][55]($_1497131485, $_1309824325); if(!$GLOBALS['____613578050'][56]($_1497131485, self::$_819535625[___1809889997(99)]) && $_2059077635[___1809889997(100)][$_1497131485] || $GLOBALS['____613578050'][57]($_1497131485, self::$_819535625[___1809889997(101)]) && $_2059077635[___1809889997(102)][$_1497131485] != self::$_819535625[___1809889997(103)][$_1497131485]) $_1073252303[]= array($_1497131485, $_2059077635[___1809889997(104)][$_1497131485]);}} $_1136961833= $GLOBALS['____613578050'][58]($_2059077635); $_1136961833= $GLOBALS['____613578050'][59]($_1136961833); COption::SetOptionString(___1809889997(105), ___1809889997(106), $_1136961833); self::$_819535625= false; foreach($_1073252303 as $_1125183966) self::__106948123($_1125183966[(244*2-488)], $_1125183966[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]);} public static function GetFeaturesList(){ self::__2143714365(); $_707404566= array(); foreach(self::$_387331251 as $_24202136 => $_447022787){ if($GLOBALS['____613578050'][60]($_24202136, self::$_819535625[___1809889997(107)])) $_1028751993= self::$_819535625[___1809889997(108)][$_24202136]; else $_1028751993=($_24202136 == ___1809889997(109))? array(___1809889997(110)): array(___1809889997(111)); $_707404566[$_24202136]= array( ___1809889997(112) => $_1028751993[(896-2*448)], ___1809889997(113) => $_1028751993[round(0+0.2+0.2+0.2+0.2+0.2)], ___1809889997(114) => array(),); $_707404566[$_24202136][___1809889997(115)]= false; if($_707404566[$_24202136][___1809889997(116)] == ___1809889997(117)){ $_707404566[$_24202136][___1809889997(118)]= $GLOBALS['____613578050'][61](($GLOBALS['____613578050'][62]()- $_707404566[$_24202136][___1809889997(119)])/ round(0+43200+43200)); if($_707404566[$_24202136][___1809889997(120)]> self::$_1369707809) $_707404566[$_24202136][___1809889997(121)]= true;} foreach($_447022787 as $_1497131485) $_707404566[$_24202136][___1809889997(122)][$_1497131485]=(!$GLOBALS['____613578050'][63]($_1497131485, self::$_819535625[___1809889997(123)]) || self::$_819535625[___1809889997(124)][$_1497131485]);} return $_707404566;} private static function __2123844915($_846842701, $_1995257544){ if(IsModuleInstalled($_846842701) == $_1995257544) return true; $_1372474905= $_SERVER[___1809889997(125)].___1809889997(126).$_846842701.___1809889997(127); if(!$GLOBALS['____613578050'][64]($_1372474905)) return false; include_once($_1372474905); $_78956618= $GLOBALS['____613578050'][65](___1809889997(128), ___1809889997(129), $_846842701); if(!$GLOBALS['____613578050'][66]($_78956618)) return false; $_957047263= new $_78956618; if($_1995257544){ if(!$_957047263->InstallDB()) return false; $_957047263->InstallEvents(); if(!$_957047263->InstallFiles()) return false;} else{ if(CModule::IncludeModule(___1809889997(130))) CSearch::DeleteIndex($_846842701); UnRegisterModule($_846842701);} return true;} protected static function OnRequestsSettingsChange($_1497131485, $_17391222){ self::__2123844915("form", $_17391222);} protected static function OnLearningSettingsChange($_1497131485, $_17391222){ self::__2123844915("learning", $_17391222);} protected static function OnJabberSettingsChange($_1497131485, $_17391222){ self::__2123844915("xmpp", $_17391222);} protected static function OnVideoConferenceSettingsChange($_1497131485, $_17391222){ self::__2123844915("video", $_17391222);} protected static function OnBizProcSettingsChange($_1497131485, $_17391222){ self::__2123844915("bizprocdesigner", $_17391222);} protected static function OnListsSettingsChange($_1497131485, $_17391222){ self::__2123844915("lists", $_17391222);} protected static function OnWikiSettingsChange($_1497131485, $_17391222){ self::__2123844915("wiki", $_17391222);} protected static function OnSupportSettingsChange($_1497131485, $_17391222){ self::__2123844915("support", $_17391222);} protected static function OnControllerSettingsChange($_1497131485, $_17391222){ self::__2123844915("controller", $_17391222);} protected static function OnAnalyticsSettingsChange($_1497131485, $_17391222){ self::__2123844915("statistic", $_17391222);} protected static function OnVoteSettingsChange($_1497131485, $_17391222){ self::__2123844915("vote", $_17391222);} protected static function OnFriendsSettingsChange($_1497131485, $_17391222){ if($_17391222) $_1800218069= "Y"; else $_1800218069= ___1809889997(131); $_913641933= CSite::GetList(($_212926047= ___1809889997(132)),($_982430020= ___1809889997(133)), array(___1809889997(134) => ___1809889997(135))); while($_895117528= $_913641933->Fetch()){ if(COption::GetOptionString(___1809889997(136), ___1809889997(137), ___1809889997(138), $_895117528[___1809889997(139)]) != $_1800218069){ COption::SetOptionString(___1809889997(140), ___1809889997(141), $_1800218069, false, $_895117528[___1809889997(142)]); COption::SetOptionString(___1809889997(143), ___1809889997(144), $_1800218069);}}} protected static function OnMicroBlogSettingsChange($_1497131485, $_17391222){ if($_17391222) $_1800218069= "Y"; else $_1800218069= ___1809889997(145); $_913641933= CSite::GetList(($_212926047= ___1809889997(146)),($_982430020= ___1809889997(147)), array(___1809889997(148) => ___1809889997(149))); while($_895117528= $_913641933->Fetch()){ if(COption::GetOptionString(___1809889997(150), ___1809889997(151), ___1809889997(152), $_895117528[___1809889997(153)]) != $_1800218069){ COption::SetOptionString(___1809889997(154), ___1809889997(155), $_1800218069, false, $_895117528[___1809889997(156)]); COption::SetOptionString(___1809889997(157), ___1809889997(158), $_1800218069);} if(COption::GetOptionString(___1809889997(159), ___1809889997(160), ___1809889997(161), $_895117528[___1809889997(162)]) != $_1800218069){ COption::SetOptionString(___1809889997(163), ___1809889997(164), $_1800218069, false, $_895117528[___1809889997(165)]); COption::SetOptionString(___1809889997(166), ___1809889997(167), $_1800218069);}}} protected static function OnPersonalFilesSettingsChange($_1497131485, $_17391222){ if($_17391222) $_1800218069= "Y"; else $_1800218069= ___1809889997(168); $_913641933= CSite::GetList(($_212926047= ___1809889997(169)),($_982430020= ___1809889997(170)), array(___1809889997(171) => ___1809889997(172))); while($_895117528= $_913641933->Fetch()){ if(COption::GetOptionString(___1809889997(173), ___1809889997(174), ___1809889997(175), $_895117528[___1809889997(176)]) != $_1800218069){ COption::SetOptionString(___1809889997(177), ___1809889997(178), $_1800218069, false, $_895117528[___1809889997(179)]); COption::SetOptionString(___1809889997(180), ___1809889997(181), $_1800218069);}}} protected static function OnPersonalBlogSettingsChange($_1497131485, $_17391222){ if($_17391222) $_1800218069= "Y"; else $_1800218069= ___1809889997(182); $_913641933= CSite::GetList(($_212926047= ___1809889997(183)),($_982430020= ___1809889997(184)), array(___1809889997(185) => ___1809889997(186))); while($_895117528= $_913641933->Fetch()){ if(COption::GetOptionString(___1809889997(187), ___1809889997(188), ___1809889997(189), $_895117528[___1809889997(190)]) != $_1800218069){ COption::SetOptionString(___1809889997(191), ___1809889997(192), $_1800218069, false, $_895117528[___1809889997(193)]); COption::SetOptionString(___1809889997(194), ___1809889997(195), $_1800218069);}}} protected static function OnPersonalPhotoSettingsChange($_1497131485, $_17391222){ if($_17391222) $_1800218069= "Y"; else $_1800218069= ___1809889997(196); $_913641933= CSite::GetList(($_212926047= ___1809889997(197)),($_982430020= ___1809889997(198)), array(___1809889997(199) => ___1809889997(200))); while($_895117528= $_913641933->Fetch()){ if(COption::GetOptionString(___1809889997(201), ___1809889997(202), ___1809889997(203), $_895117528[___1809889997(204)]) != $_1800218069){ COption::SetOptionString(___1809889997(205), ___1809889997(206), $_1800218069, false, $_895117528[___1809889997(207)]); COption::SetOptionString(___1809889997(208), ___1809889997(209), $_1800218069);}}} protected static function OnPersonalForumSettingsChange($_1497131485, $_17391222){ if($_17391222) $_1800218069= "Y"; else $_1800218069= ___1809889997(210); $_913641933= CSite::GetList(($_212926047= ___1809889997(211)),($_982430020= ___1809889997(212)), array(___1809889997(213) => ___1809889997(214))); while($_895117528= $_913641933->Fetch()){ if(COption::GetOptionString(___1809889997(215), ___1809889997(216), ___1809889997(217), $_895117528[___1809889997(218)]) != $_1800218069){ COption::SetOptionString(___1809889997(219), ___1809889997(220), $_1800218069, false, $_895117528[___1809889997(221)]); COption::SetOptionString(___1809889997(222), ___1809889997(223), $_1800218069);}}} protected static function OnTasksSettingsChange($_1497131485, $_17391222){ if($_17391222) $_1800218069= "Y"; else $_1800218069= ___1809889997(224); $_913641933= CSite::GetList(($_212926047= ___1809889997(225)),($_982430020= ___1809889997(226)), array(___1809889997(227) => ___1809889997(228))); while($_895117528= $_913641933->Fetch()){ if(COption::GetOptionString(___1809889997(229), ___1809889997(230), ___1809889997(231), $_895117528[___1809889997(232)]) != $_1800218069){ COption::SetOptionString(___1809889997(233), ___1809889997(234), $_1800218069, false, $_895117528[___1809889997(235)]); COption::SetOptionString(___1809889997(236), ___1809889997(237), $_1800218069);} if(COption::GetOptionString(___1809889997(238), ___1809889997(239), ___1809889997(240), $_895117528[___1809889997(241)]) != $_1800218069){ COption::SetOptionString(___1809889997(242), ___1809889997(243), $_1800218069, false, $_895117528[___1809889997(244)]); COption::SetOptionString(___1809889997(245), ___1809889997(246), $_1800218069);}} self::__2123844915(___1809889997(247), $_17391222);} protected static function OnCalendarSettingsChange($_1497131485, $_17391222){ if($_17391222) $_1800218069= "Y"; else $_1800218069= ___1809889997(248); $_913641933= CSite::GetList(($_212926047= ___1809889997(249)),($_982430020= ___1809889997(250)), array(___1809889997(251) => ___1809889997(252))); while($_895117528= $_913641933->Fetch()){ if(COption::GetOptionString(___1809889997(253), ___1809889997(254), ___1809889997(255), $_895117528[___1809889997(256)]) != $_1800218069){ COption::SetOptionString(___1809889997(257), ___1809889997(258), $_1800218069, false, $_895117528[___1809889997(259)]); COption::SetOptionString(___1809889997(260), ___1809889997(261), $_1800218069);} if(COption::GetOptionString(___1809889997(262), ___1809889997(263), ___1809889997(264), $_895117528[___1809889997(265)]) != $_1800218069){ COption::SetOptionString(___1809889997(266), ___1809889997(267), $_1800218069, false, $_895117528[___1809889997(268)]); COption::SetOptionString(___1809889997(269), ___1809889997(270), $_1800218069);}}} protected static function OnSMTPSettingsChange($_1497131485, $_17391222){ self::__2123844915("mail", $_17391222);} protected static function OnExtranetSettingsChange($_1497131485, $_17391222){ $_1269194057= COption::GetOptionString("extranet", "extranet_site", ""); if($_1269194057){ $_49601726= new CSite; $_49601726->Update($_1269194057, array(___1809889997(271) =>($_17391222? ___1809889997(272): ___1809889997(273))));} self::__2123844915(___1809889997(274), $_17391222);} protected static function OnDAVSettingsChange($_1497131485, $_17391222){ self::__2123844915("dav", $_17391222);} protected static function OntimemanSettingsChange($_1497131485, $_17391222){ self::__2123844915("timeman", $_17391222);} protected static function Onintranet_sharepointSettingsChange($_1497131485, $_17391222){ if($_17391222){ RegisterModuleDependences("iblock", "OnAfterIBlockElementAdd", "intranet", "CIntranetEventHandlers", "SPRegisterUpdatedItem"); RegisterModuleDependences(___1809889997(275), ___1809889997(276), ___1809889997(277), ___1809889997(278), ___1809889997(279)); CAgent::AddAgent(___1809889997(280), ___1809889997(281), ___1809889997(282), round(0+500)); CAgent::AddAgent(___1809889997(283), ___1809889997(284), ___1809889997(285), round(0+150+150)); CAgent::AddAgent(___1809889997(286), ___1809889997(287), ___1809889997(288), round(0+720+720+720+720+720));} else{ UnRegisterModuleDependences(___1809889997(289), ___1809889997(290), ___1809889997(291), ___1809889997(292), ___1809889997(293)); UnRegisterModuleDependences(___1809889997(294), ___1809889997(295), ___1809889997(296), ___1809889997(297), ___1809889997(298)); CAgent::RemoveAgent(___1809889997(299), ___1809889997(300)); CAgent::RemoveAgent(___1809889997(301), ___1809889997(302)); CAgent::RemoveAgent(___1809889997(303), ___1809889997(304));}} protected static function OncrmSettingsChange($_1497131485, $_17391222){ if($_17391222) COption::SetOptionString("crm", "form_features", "Y"); self::__2123844915(___1809889997(305), $_17391222);} protected static function OnClusterSettingsChange($_1497131485, $_17391222){ self::__2123844915("cluster", $_17391222);} protected static function OnMultiSitesSettingsChange($_1497131485, $_17391222){ if($_17391222) RegisterModuleDependences("main", "OnBeforeProlog", "main", "CWizardSolPanelIntranet", "ShowPanel", 100, "/modules/intranet/panel_button.php"); else UnRegisterModuleDependences(___1809889997(306), ___1809889997(307), ___1809889997(308), ___1809889997(309), ___1809889997(310), ___1809889997(311));} protected static function OnIdeaSettingsChange($_1497131485, $_17391222){ self::__2123844915("idea", $_17391222);} protected static function OnMeetingSettingsChange($_1497131485, $_17391222){ self::__2123844915("meeting", $_17391222);} protected static function OnXDImportSettingsChange($_1497131485, $_17391222){ self::__2123844915("xdimport", $_17391222);}} $GLOBALS['____613578050'][67](___1809889997(312), ___1809889997(313));/**/			//Do not remove this

//component 2.0 template engines
$GLOBALS["arCustomTemplateEngines"] = array();

require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/urlrewriter.php");

/**
 * Defined in dbconn.php
 * @param string $DBType
 */

require_once(__DIR__.'/autoload.php');
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/".$DBType."/agent.php");
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/user.php");
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/".$DBType."/event.php");
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/menu.php");
AddEventHandler("main", "OnAfterEpilog", array("\\Bitrix\\Main\\Data\\ManagedCache", "finalize"));
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/".$DBType."/usertype.php");

if(file_exists(($_fname = $_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/update_db_updater.php")))
{
	$US_HOST_PROCESS_MAIN = False;
	include($_fname);
}

if(file_exists(($_fname = $_SERVER["DOCUMENT_ROOT"]."/bitrix/init.php")))
	include_once($_fname);

if(($_fname = getLocalPath("php_interface/init.php", BX_PERSONAL_ROOT)) !== false)
	include_once($_SERVER["DOCUMENT_ROOT"].$_fname);

if(($_fname = getLocalPath("php_interface/".SITE_ID."/init.php", BX_PERSONAL_ROOT)) !== false)
	include_once($_SERVER["DOCUMENT_ROOT"].$_fname);

if(!defined("BX_FILE_PERMISSIONS"))
	define("BX_FILE_PERMISSIONS", 0644);
if(!defined("BX_DIR_PERMISSIONS"))
	define("BX_DIR_PERMISSIONS", 0755);

//global var, is used somewhere
$GLOBALS["sDocPath"] = $GLOBALS["APPLICATION"]->GetCurPage();

if((!(defined("STATISTIC_ONLY") && STATISTIC_ONLY && mb_substr($GLOBALS["APPLICATION"]->GetCurPage(), 0, mb_strlen(BX_ROOT."/admin/")) != BX_ROOT."/admin/")) && COption::GetOptionString("main", "include_charset", "Y")=="Y" && LANG_CHARSET <> '')
	header("Content-Type: text/html; charset=".LANG_CHARSET);

if(COption::GetOptionString("main", "set_p3p_header", "Y")=="Y")
	header("P3P: policyref=\"/bitrix/p3p.xml\", CP=\"NON DSP COR CUR ADM DEV PSA PSD OUR UNR BUS UNI COM NAV INT DEM STA\"");

header("X-Powered-CMS: Bitrix Site Manager (".(LICENSE_KEY == "DEMO"? "DEMO" : md5("BITRIX".LICENSE_KEY."LICENCE")).")");
if (COption::GetOptionString("main", "update_devsrv", "") == "Y")
	header("X-DevSrv-CMS: Bitrix");

define("BX_CRONTAB_SUPPORT", defined("BX_CRONTAB"));

//agents
if(COption::GetOptionString("main", "check_agents", "Y") == "Y")
{
	$application->addBackgroundJob(["CAgent", "CheckAgents"], [], \Bitrix\Main\Application::JOB_PRIORITY_LOW);
}

//send email events
if(COption::GetOptionString("main", "check_events", "Y") !== "N")
{
	$application->addBackgroundJob(["CEvent", "CheckEvents"], [], \Bitrix\Main\Application::JOB_PRIORITY_LOW-1);
}

$healerOfEarlySessionStart = new HealerEarlySessionStart();
$healerOfEarlySessionStart->process($application->getKernelSession());

$kernelSession = $application->getKernelSession();
$kernelSession->start();
$application->getSessionLocalStorageManager()->setUniqueId($kernelSession->getId());

foreach (GetModuleEvents("main", "OnPageStart", true) as $arEvent)
	ExecuteModuleEventEx($arEvent);

//define global user object
$GLOBALS["USER"] = new CUser;

//session control from group policy
$arPolicy = $GLOBALS["USER"]->GetSecurityPolicy();
$currTime = time();
if(
	(
		//IP address changed
		$kernelSession['SESS_IP']
		&& $arPolicy["SESSION_IP_MASK"] <> ''
		&& (
			(ip2long($arPolicy["SESSION_IP_MASK"]) & ip2long($kernelSession['SESS_IP']))
			!=
			(ip2long($arPolicy["SESSION_IP_MASK"]) & ip2long($_SERVER['REMOTE_ADDR']))
		)
	)
	||
	(
		//session timeout
		$arPolicy["SESSION_TIMEOUT"]>0
		&& $kernelSession['SESS_TIME']>0
		&& $currTime-$arPolicy["SESSION_TIMEOUT"]*60 > $kernelSession['SESS_TIME']
	)
	||
	(
		//signed session
		isset($kernelSession["BX_SESSION_SIGN"])
		&& $kernelSession["BX_SESSION_SIGN"] <> bitrix_sess_sign()
	)
	||
	(
		//session manually expired, e.g. in $User->LoginHitByHash
		isSessionExpired()
	)
)
{
	$compositeSessionManager = $application->getCompositeSessionManager();
	$compositeSessionManager->destroy();

	$application->getSession()->setId(md5(uniqid(rand(), true)));
	$compositeSessionManager->start();

	$GLOBALS["USER"] = new CUser;
}
$kernelSession['SESS_IP'] = $_SERVER['REMOTE_ADDR'];
if (empty($kernelSession['SESS_TIME']))
{
	$kernelSession['SESS_TIME'] = $currTime;
}
elseif (($currTime - $kernelSession['SESS_TIME']) > 60)
{
	$kernelSession['SESS_TIME'] = $currTime;
}
if(!isset($kernelSession["BX_SESSION_SIGN"]))
	$kernelSession["BX_SESSION_SIGN"] = bitrix_sess_sign();

//session control from security module
if(
	(COption::GetOptionString("main", "use_session_id_ttl", "N") == "Y")
	&& (COption::GetOptionInt("main", "session_id_ttl", 0) > 0)
	&& !defined("BX_SESSION_ID_CHANGE")
)
{
	if(!isset($kernelSession['SESS_ID_TIME']))
	{
		$kernelSession['SESS_ID_TIME'] = $currTime;
	}
	elseif(($kernelSession['SESS_ID_TIME'] + COption::GetOptionInt("main", "session_id_ttl")) < $kernelSession['SESS_TIME'])
	{
		$compositeSessionManager = $application->getCompositeSessionManager();
		$compositeSessionManager->regenerateId();

		$kernelSession['SESS_ID_TIME'] = $currTime;
	}
}

define("BX_STARTED", true);

if (isset($kernelSession['BX_ADMIN_LOAD_AUTH']))
{
	define('ADMIN_SECTION_LOAD_AUTH', 1);
	unset($kernelSession['BX_ADMIN_LOAD_AUTH']);
}

if(!defined("NOT_CHECK_PERMISSIONS") || NOT_CHECK_PERMISSIONS!==true)
{
	$doLogout = isset($_REQUEST["logout"]) && (strtolower($_REQUEST["logout"]) == "yes");

	if($doLogout && $GLOBALS["USER"]->IsAuthorized())
	{
		$secureLogout = (\Bitrix\Main\Config\Option::get("main", "secure_logout", "N") == "Y");

		if(!$secureLogout || check_bitrix_sessid())
		{
			$GLOBALS["USER"]->Logout();
			LocalRedirect($GLOBALS["APPLICATION"]->GetCurPageParam('', array('logout', 'sessid')));
		}
	}

	// authorize by cookies
	if(!$GLOBALS["USER"]->IsAuthorized())
	{
		$GLOBALS["USER"]->LoginByCookies();
	}

	$arAuthResult = false;

	//http basic and digest authorization
	if(($httpAuth = $GLOBALS["USER"]->LoginByHttpAuth()) !== null)
	{
		$arAuthResult = $httpAuth;
		$GLOBALS["APPLICATION"]->SetAuthResult($arAuthResult);
	}

	//Authorize user from authorization html form
	//Only POST is accepted
	if(isset($_POST["AUTH_FORM"]) && $_POST["AUTH_FORM"] <> '')
	{
		$bRsaError = false;
		if(COption::GetOptionString('main', 'use_encrypted_auth', 'N') == 'Y')
		{
			//possible encrypted user password
			$sec = new CRsaSecurity();
			if(($arKeys = $sec->LoadKeys()))
			{
				$sec->SetKeys($arKeys);
				$errno = $sec->AcceptFromForm(['USER_PASSWORD', 'USER_CONFIRM_PASSWORD', 'USER_CURRENT_PASSWORD']);
				if($errno == CRsaSecurity::ERROR_SESS_CHECK)
					$arAuthResult = array("MESSAGE"=>GetMessage("main_include_decode_pass_sess"), "TYPE"=>"ERROR");
				elseif($errno < 0)
					$arAuthResult = array("MESSAGE"=>GetMessage("main_include_decode_pass_err", array("#ERRCODE#"=>$errno)), "TYPE"=>"ERROR");

				if($errno < 0)
					$bRsaError = true;
			}
		}

		if($bRsaError == false)
		{
			if(!defined("ADMIN_SECTION") || ADMIN_SECTION !== true)
				$USER_LID = SITE_ID;
			else
				$USER_LID = false;

			if($_POST["TYPE"] == "AUTH")
			{
				$arAuthResult = $GLOBALS["USER"]->Login($_POST["USER_LOGIN"], $_POST["USER_PASSWORD"], $_POST["USER_REMEMBER"]);
			}
			elseif($_POST["TYPE"] == "OTP")
			{
				$arAuthResult = $GLOBALS["USER"]->LoginByOtp($_POST["USER_OTP"], $_POST["OTP_REMEMBER"], $_POST["captcha_word"], $_POST["captcha_sid"]);
			}
			elseif($_POST["TYPE"] == "SEND_PWD")
			{
				$arAuthResult = CUser::SendPassword($_POST["USER_LOGIN"], $_POST["USER_EMAIL"], $USER_LID, $_POST["captcha_word"], $_POST["captcha_sid"], $_POST["USER_PHONE_NUMBER"]);
			}
			elseif($_POST["TYPE"] == "CHANGE_PWD")
			{
				$arAuthResult = $GLOBALS["USER"]->ChangePassword($_POST["USER_LOGIN"], $_POST["USER_CHECKWORD"], $_POST["USER_PASSWORD"], $_POST["USER_CONFIRM_PASSWORD"], $USER_LID, $_POST["captcha_word"], $_POST["captcha_sid"], true, $_POST["USER_PHONE_NUMBER"], $_POST["USER_CURRENT_PASSWORD"]);
			}
			elseif(COption::GetOptionString("main", "new_user_registration", "N") == "Y" && $_POST["TYPE"] == "REGISTRATION" && (!defined("ADMIN_SECTION") || ADMIN_SECTION !== true))
			{
				$arAuthResult = $GLOBALS["USER"]->Register($_POST["USER_LOGIN"], $_POST["USER_NAME"], $_POST["USER_LAST_NAME"], $_POST["USER_PASSWORD"], $_POST["USER_CONFIRM_PASSWORD"], $_POST["USER_EMAIL"], $USER_LID, $_POST["captcha_word"], $_POST["captcha_sid"], false, $_POST["USER_PHONE_NUMBER"]);
			}

			if($_POST["TYPE"] == "AUTH" || $_POST["TYPE"] == "OTP")
			{
				//special login form in the control panel
				if($arAuthResult === true && defined('ADMIN_SECTION') && ADMIN_SECTION === true)
				{
					//store cookies for next hit (see CMain::GetSpreadCookieHTML())
					$GLOBALS["APPLICATION"]->StoreCookies();
					$kernelSession['BX_ADMIN_LOAD_AUTH'] = true;

					CMain::FinalActions('<script type="text/javascript">window.onload=function(){(window.BX || window.parent.BX).AUTHAGENT.setAuthResult(false);};</script>');
					die();
				}
			}
		}
		$GLOBALS["APPLICATION"]->SetAuthResult($arAuthResult);
	}
	elseif(!$GLOBALS["USER"]->IsAuthorized())
	{
		//Authorize by unique URL
		$GLOBALS["USER"]->LoginHitByHash();
	}
}

//logout or re-authorize the user if something importand has changed
$GLOBALS["USER"]->CheckAuthActions();

//magic short URI
if(defined("BX_CHECK_SHORT_URI") && BX_CHECK_SHORT_URI && CBXShortUri::CheckUri())
{
	//local redirect inside
	die();
}

//application password scope control
if(($applicationID = $GLOBALS["USER"]->GetParam("APPLICATION_ID")) !== null)
{
	$appManager = \Bitrix\Main\Authentication\ApplicationManager::getInstance();
	if($appManager->checkScope($applicationID) !== true)
	{
		$event = new \Bitrix\Main\Event("main", "onApplicationScopeError", Array('APPLICATION_ID' => $applicationID));
		$event->send();

		CHTTP::SetStatus("403 Forbidden");
		die();
	}
}

//define the site template
if(!defined("ADMIN_SECTION") || ADMIN_SECTION !== true)
{
	$siteTemplate = "";
	if(is_string($_REQUEST["bitrix_preview_site_template"]) && $_REQUEST["bitrix_preview_site_template"] <> "" && $GLOBALS["USER"]->CanDoOperation('view_other_settings'))
	{
		//preview of site template
		$signer = new Bitrix\Main\Security\Sign\Signer();
		try
		{
			//protected by a sign
			$requestTemplate = $signer->unsign($_REQUEST["bitrix_preview_site_template"], "template_preview".bitrix_sessid());

			$aTemplates = CSiteTemplate::GetByID($requestTemplate);
			if($template = $aTemplates->Fetch())
			{
				$siteTemplate = $template["ID"];

				//preview of unsaved template
				if(isset($_GET['bx_template_preview_mode']) && $_GET['bx_template_preview_mode'] == 'Y' && $GLOBALS["USER"]->CanDoOperation('edit_other_settings'))
				{
					define("SITE_TEMPLATE_PREVIEW_MODE", true);
				}
			}
		}
		catch(\Bitrix\Main\Security\Sign\BadSignatureException $e)
		{
		}
	}
	if($siteTemplate == "")
	{
		$siteTemplate = CSite::GetCurTemplate();
	}
	define("SITE_TEMPLATE_ID", $siteTemplate);
	define("SITE_TEMPLATE_PATH", getLocalPath('templates/'.SITE_TEMPLATE_ID, BX_PERSONAL_ROOT));
}

//magic parameters: show page creation time
if(isset($_GET["show_page_exec_time"]))
{
	if($_GET["show_page_exec_time"]=="Y" || $_GET["show_page_exec_time"]=="N")
		$kernelSession["SESS_SHOW_TIME_EXEC"] = $_GET["show_page_exec_time"];
}

//magic parameters: show included file processing time
if(isset($_GET["show_include_exec_time"]))
{
	if($_GET["show_include_exec_time"]=="Y" || $_GET["show_include_exec_time"]=="N")
		$kernelSession["SESS_SHOW_INCLUDE_TIME_EXEC"] = $_GET["show_include_exec_time"];
}

//magic parameters: show include areas
if(isset($_GET["bitrix_include_areas"]) && $_GET["bitrix_include_areas"] <> "")
	$GLOBALS["APPLICATION"]->SetShowIncludeAreas($_GET["bitrix_include_areas"]=="Y");

//magic sound
if($GLOBALS["USER"]->IsAuthorized())
{
	$cookie_prefix = COption::GetOptionString('main', 'cookie_name', 'BITRIX_SM');
	if(!isset($_COOKIE[$cookie_prefix.'_SOUND_LOGIN_PLAYED']))
		$GLOBALS["APPLICATION"]->set_cookie('SOUND_LOGIN_PLAYED', 'Y', 0);
}

//magic cache
\Bitrix\Main\Composite\Engine::shouldBeEnabled();

foreach(GetModuleEvents("main", "OnBeforeProlog", true) as $arEvent)
	ExecuteModuleEventEx($arEvent);

if((!defined("NOT_CHECK_PERMISSIONS") || NOT_CHECK_PERMISSIONS!==true) && (!defined("NOT_CHECK_FILE_PERMISSIONS") || NOT_CHECK_FILE_PERMISSIONS!==true))
{
	$real_path = $request->getScriptFile();

	if(!$GLOBALS["USER"]->CanDoFileOperation('fm_view_file', array(SITE_ID, $real_path)) || (defined("NEED_AUTH") && NEED_AUTH && !$GLOBALS["USER"]->IsAuthorized()))
	{
		/** @noinspection PhpUndefinedVariableInspection */
		if($GLOBALS["USER"]->IsAuthorized() && $arAuthResult["MESSAGE"] == '')
		{
			$arAuthResult = array("MESSAGE"=>GetMessage("ACCESS_DENIED").' '.GetMessage("ACCESS_DENIED_FILE", array("#FILE#"=>$real_path)), "TYPE"=>"ERROR");

			if(COption::GetOptionString("main", "event_log_permissions_fail", "N") === "Y")
			{
				CEventLog::Log("SECURITY", "USER_PERMISSIONS_FAIL", "main", $GLOBALS["USER"]->GetID(), $real_path);
			}
		}

		if(defined("ADMIN_SECTION") && ADMIN_SECTION==true)
		{
			if ($_REQUEST["mode"]=="list" || $_REQUEST["mode"]=="settings")
			{
				echo "<script>top.location='".$GLOBALS["APPLICATION"]->GetCurPage()."?".DeleteParam(array("mode"))."';</script>";
				die();
			}
			elseif ($_REQUEST["mode"]=="frame")
			{
				echo "<script type=\"text/javascript\">
					var w = (opener? opener.window:parent.window);
					w.location.href='".$GLOBALS["APPLICATION"]->GetCurPage()."?".DeleteParam(array("mode"))."';
				</script>";
				die();
			}
			elseif(defined("MOBILE_APP_ADMIN") && MOBILE_APP_ADMIN==true)
			{
				echo json_encode(Array("status"=>"failed"));
				die();
			}
		}

		/** @noinspection PhpUndefinedVariableInspection */
		$GLOBALS["APPLICATION"]->AuthForm($arAuthResult);
	}
}

/*ZDUyZmZNTcxNTkyODM0MjMxZTYxMmEyMzYyNGJmMjg5NThiOGE=*/$GLOBALS['____1312217458']= array(base64_decode('bXRfcmFu'.'ZA=='),base64_decode('ZX'.'hw'.'bG9kZQ'.'=='),base64_decode('cG'.'Fjaw='.'='),base64_decode('bWQ'.'1'),base64_decode(''.'Y29uc3'.'Rh'.'bn'.'Q'.'='),base64_decode('a'.'GFzaF9'.'obW'.'Fj'),base64_decode('c3RyY2'.'1w'),base64_decode('aXNfb2JqZ'.'WN0'),base64_decode('Y'.'2F'.'sbF91c2Vy'.'X2Z1bmM='),base64_decode(''.'Y2FsbF91c2Vy'.'X2'.'Z1bmM'.'='),base64_decode(''.'Y2'.'F'.'sbF91c2Vy'.'X2Z1bmM'.'='),base64_decode(''.'Y'.'2FsbF9'.'1c2VyX2Z1'.'bmM='),base64_decode(''.'Y2Fsb'.'F9'.'1'.'c2'.'VyX'.'2Z1bmM='));if(!function_exists(__NAMESPACE__.'\\___1305760941')){function ___1305760941($_1282404284){static $_1643079788= false; if($_1643079788 == false) $_1643079788=array('REI'.'=',''.'U0VMRU'.'NUIFZB'.'TFVF'.'IEZST0'.'0gY'.'l9vc'.'HRp'.'b24gV0'.'hF'.'UkUgTkFNR'.'T0n'.'flB'.'BUkFNX'.'01BW'.'F9VU0'.'VSU'.'ycgQU5EI'.'E'.'1PRFVMRV9JRD0nbWF'.'pbi'.'cgQU5EI'.'FNJ'.'VEVf'.'SUQgSVMg'.'T'.'lVM'.'TA==','Vk'.'FMVUU=','Lg==','SCo=','Yml0c'.'ml4','TElDRU5TRV9L'.'RV'.'k=',''.'c'.'2hhMj'.'U2','VVN'.'FUg==',''.'VVN'.'FUg='.'=',''.'VVNFUg==','SX'.'NBdXRob'.'3J'.'pe'.'m'.'Vk','VVNFUg==','SX'.'NBZ'.'G'.'1'.'p'.'bg==','QVB'.'Q'.'TElDQ'.'VRJ'.'T04=','UmV'.'zdGFydEJ1Zm'.'Zlcg==',''.'TG9'.'jYWxS'.'Z'.'WR'.'pcm'.'VjdA='.'=','L2xp'.'Y2Vuc'.'2VfcmVzdHJpY3'.'Rpb2'.'4uc'.'Ghw','X'.'EJpdHJp'.'eFxNYWluXENvb'.'mZpZ1xPcHRp'.'b24'.'6'.'O'.'nN'.'ldA='.'=',''.'bWFpbg==','UE'.'FSQU1fTUFYX'.'1VTRVJ'.'T');return base64_decode($_1643079788[$_1282404284]);}};if($GLOBALS['____1312217458'][0](round(0+0.33333333333333+0.33333333333333+0.33333333333333), round(0+10+10)) == round(0+2.3333333333333+2.3333333333333+2.3333333333333)){ $_219498556= $GLOBALS[___1305760941(0)]->Query(___1305760941(1), true); if($_313106363= $_219498556->Fetch()){ $_1109744048= $_313106363[___1305760941(2)]; list($_532157266, $_1435281804)= $GLOBALS['____1312217458'][1](___1305760941(3), $_1109744048); $_932237489= $GLOBALS['____1312217458'][2](___1305760941(4), $_532157266); $_1451172462= ___1305760941(5).$GLOBALS['____1312217458'][3]($GLOBALS['____1312217458'][4](___1305760941(6))); $_669136967= $GLOBALS['____1312217458'][5](___1305760941(7), $_1435281804, $_1451172462, true); if($GLOBALS['____1312217458'][6]($_669136967, $_932237489) !== min(10,0,3.3333333333333)){ if(isset($GLOBALS[___1305760941(8)]) && $GLOBALS['____1312217458'][7]($GLOBALS[___1305760941(9)]) && $GLOBALS['____1312217458'][8](array($GLOBALS[___1305760941(10)], ___1305760941(11))) &&!$GLOBALS['____1312217458'][9](array($GLOBALS[___1305760941(12)], ___1305760941(13)))){ $GLOBALS['____1312217458'][10](array($GLOBALS[___1305760941(14)], ___1305760941(15))); $GLOBALS['____1312217458'][11](___1305760941(16), ___1305760941(17), true);}}} else{ $GLOBALS['____1312217458'][12](___1305760941(18), ___1305760941(19), ___1305760941(20), round(0+6+6));}}/**/       //Do not remove this

