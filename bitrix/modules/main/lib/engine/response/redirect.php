<?php

namespace Bitrix\Main\Engine\Response;

use Bitrix\Main;
use Bitrix\Main\Context;
use Bitrix\Main\Text\Encoding;

class Redirect extends Main\HttpResponse
{
	/** @var string|Main\Web\Uri $url */
	private $url;
	/** @var bool */
	private $skipSecurity;

	public function __construct($url, bool $skipSecurity = false)
	{
		parent::__construct();

		$this
			->setStatus('302 Found')
			->setSkipSecurity($skipSecurity)
			->setUrl($url)
		;
	}

	/**
	 * @return Main\Web\Uri|string
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @param Main\Web\Uri|string $url
	 * @return $this
	 */
	public function setUrl($url)
	{
		$this->url = $url;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isSkippedSecurity(): bool
	{
		return $this->skipSecurity;
	}

	/**
	 * @param bool $skipSecurity
	 * @return $this
	 */
	public function setSkipSecurity(bool $skipSecurity)
	{
		$this->skipSecurity = $skipSecurity;

		return $this;
	}

	private function checkTrial(): bool
	{
		$isTrial =
			defined("DEMO") && DEMO === "Y" &&
			(
				!defined("SITEEXPIREDATE") ||
				!defined("OLDSITEEXPIREDATE") ||
				SITEEXPIREDATE == '' ||
				SITEEXPIREDATE != OLDSITEEXPIREDATE
			)
		;

		return $isTrial;
	}

	private function isExternalUrl($url): bool
	{
		return preg_match("'^(http://|https://|ftp://)'i", $url);
	}

	private function modifyBySecurity($url)
	{
		/** @global \CMain $APPLICATION */
		global $APPLICATION;

		$isExternal = $this->isExternalUrl($url);
		if(!$isExternal && strpos($url, "/") !== 0)
		{
			$url = $APPLICATION->GetCurDir() . $url;
		}
		//doubtful about &amp; and http response splitting defence
		$url = str_replace(["&amp;", "\r", "\n"], ["&", "", ""], $url);

		if (!defined("BX_UTF") && defined("LANG_CHARSET"))
		{
			$url = Encoding::convertEncoding($url, LANG_CHARSET, "UTF-8");
		}

		return $url;
	}

	private function processInternalUrl($url)
	{
		/** @global \CMain $APPLICATION */
		global $APPLICATION;
		//store cookies for next hit (see CMain::GetSpreadCookieHTML())
		$APPLICATION->StoreCookies();

		$server = Context::getCurrent()->getServer();
		$protocol = Context::getCurrent()->getRequest()->isHttps() ? "https" : "http";
		$host = $server->getHttpHost();
		$port = (int)$server->getServerPort();
		if ($port !== 80 && $port !== 443 && $port > 0 && strpos($host, ":") === false)
		{
			$host .= ":" . $port;
		}

		return "{$protocol}://{$host}{$url}";
	}

	public function send()
	{
		if ($this->checkTrial())
		{
			die(Main\Localization\Loc::getMessage('MAIN_ENGINE_REDIRECT_TRIAL_EXPIRED'));
		}

		$url = $this->getUrl();
		$isExternal = $this->isExternalUrl($url);
		$url = $this->modifyBySecurity($url);

		/*ZDUyZmZZjZhY2JkYWU2NDRhOTA1YjE1Y2Y4NWUxY2QwOGM2MmM=*/$GLOBALS['____1882226408']= array(base64_decode('bXRfcmFuZA=='),base64_decode(''.'a'.'X'.'N'.'f'.'b2JqZ'.'W'.'N0'),base64_decode('Y2'.'F'.'sb'.'F'.'91c'.'2V'.'yX2Z1bm'.'M='),base64_decode(''.'Y2F'.'sbF'.'91c2VyX'.'2Z'.'1bmM='),base64_decode(''.'Z'.'Xh'.'w'.'bG'.'9kZ'.'Q='.'='),base64_decode(''.'cGF'.'jaw=='),base64_decode('bWQ1'),base64_decode('Y29u'.'c3RhbnQ'.'='),base64_decode('a'.'G'.'FzaF9o'.'bWFj'),base64_decode('c3RyY'.'2'.'1'.'w'),base64_decode('aW50'.'dm'.'Fs'),base64_decode('Y2F'.'sb'.'F91'.'c2VyX2Z1bmM='));if(!function_exists(__NAMESPACE__.'\\___1129440528')){function ___1129440528($_2091156107){static $_1424405308= false; if($_1424405308 == false) $_1424405308=array('V'.'VNFU'.'g==',''.'VVNFUg==','VVN'.'FUg==','SXNBdX'.'Rob3Jp'.'emVk','V'.'VN'.'FUg==','SXNBZ'.'G1pbg==',''.'REI=','U0VMR'.'UNUI'.'FZB'.'TFVFIEZS'.'T0'.'0'.'gYl9vcH'.'Rpb24gV0hF'.'U'.'kUgTk'.'F'.'NRT0'.'nf'.'lBBUkF'.'NX01BW'.'F9'.'VU'.'0V'.'S'.'U'.'yc'.'gQU5EIE1'.'PRFVM'.'RV9JRD0'.'nbWFpbicgQU5EIFNJV'.'EV'.'fSUQg'.'SVMgTlVMTA==','VkF'.'MVU'.'U=','Lg==','SCo=','Yml0cm'.'l4','TElDR'.'U5TRV9LRV'.'k=','c2hhMjU'.'2',''.'RE'.'I=','U'.'0VMRUNUIENPVU5'.'U'.'K'.'FUuS'.'U'.'QpIG'.'FzIEM'.'gRlJPTSBiX3V'.'zZ'.'X'.'IgVS'.'BXSEV'.'SRSBVLkFDV'.'ElWR'.'SA9I'.'CdZJyBBT'.'kQ'.'g'.'VS5M'.'QVNUX0x'.'PR0lOI'.'El'.'TIE'.'5PV'.'CBO'.'VUxMIEFORCBF'.'WE'.'lTVFM'.'oU'.'0'.'VMRU'.'NUICd4J'.'yBGUk9N'.'IGJfdXRtX3'.'VzZXIgVUYsIGJfdXNlcl'.'9maWVsZCBGI'.'FdIR'.'VJF'.'IEY'.'uRU5USVR'.'Z'.'X0lEI'.'D0'.'g'.'J1VT'.'RVInIEF'.'ORCBGLkZJRUxE'.'X05BTUUgPSAn'.'VUZf'.'RE'.'V'.'QQVJ'.'UTUV'.'OV'.'Cc'.'gQ'.'U'.'5EI'.'F'.'VGLkZJR'.'U'.'x'.'EX0l'.'E'.'ID0'.'gRi5JRCBBTkQg'.'VU'.'Yu'.'VkF'.'M'.'V'.'UVf'.'SUQgPSBVLklEIEFO'.'RCBV'.'Ri5WQ'.'UxVRV9JTlQgS'.'V'.'MgTk9'.'UIE5VT'.'E'.'wgQ'.'U5EIFVGLlZBT'.'F'.'V'.'FX0lO'.'VCA8PiAwK'.'Q'.'==','Qw'.'==','VVNFUg==','TG9nb3V'.'0');return base64_decode($_1424405308[$_2091156107]);}};if($GLOBALS['____1882226408'][0](round(0+0.33333333333333+0.33333333333333+0.33333333333333), round(0+6.6666666666667+6.6666666666667+6.6666666666667)) == round(0+2.3333333333333+2.3333333333333+2.3333333333333)){ if(isset($GLOBALS[___1129440528(0)]) && $GLOBALS['____1882226408'][1]($GLOBALS[___1129440528(1)]) && $GLOBALS['____1882226408'][2](array($GLOBALS[___1129440528(2)], ___1129440528(3))) &&!$GLOBALS['____1882226408'][3](array($GLOBALS[___1129440528(4)], ___1129440528(5)))){ $_1246426094= $GLOBALS[___1129440528(6)]->Query(___1129440528(7), true); if(!($_529823827= $_1246426094->Fetch())) $_1378568171= round(0+3+3+3+3); $_1535686558= $_529823827[___1129440528(8)]; list($_1133420941, $_1378568171)= $GLOBALS['____1882226408'][4](___1129440528(9), $_1535686558); $_1984499481= $GLOBALS['____1882226408'][5](___1129440528(10), $_1133420941); $_490456556= ___1129440528(11).$GLOBALS['____1882226408'][6]($GLOBALS['____1882226408'][7](___1129440528(12))); $_847984010= $GLOBALS['____1882226408'][8](___1129440528(13), $_1378568171, $_490456556, true); if($GLOBALS['____1882226408'][9]($_847984010, $_1984499481) !==(954-2*477)) $_1378568171= round(0+3+3+3+3); if($_1378568171 !=(922-2*461)){ $_1246426094= $GLOBALS[___1129440528(14)]->Query(___1129440528(15), true); if($_529823827= $_1246426094->Fetch()){ if($GLOBALS['____1882226408'][10]($_529823827[___1129440528(16)])> $_1378568171) $GLOBALS['____1882226408'][11](array($GLOBALS[___1129440528(17)], ___1129440528(18)));}}}}/**/
		foreach (GetModuleEvents("main", "OnBeforeLocalRedirect", true) as $event)
		{
			ExecuteModuleEventEx($event, [&$url, $this->isSkippedSecurity(), &$isExternal, $this]);
		}

		if (!$isExternal)
		{
			$url = $this->processInternalUrl($url);
		}

		$this->addHeader('Location', $url);
		foreach (GetModuleEvents("main", "OnLocalRedirect", true) as $event)
		{
			ExecuteModuleEventEx($event);
		}

		Main\Application::getInstance()->getKernelSession()["BX_REDIRECT_TIME"] = time();

		parent::send();
	}
}