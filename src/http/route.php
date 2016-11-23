<?php namespace estvoyage\risingsun\http;

use
	estvoyage\risingsun\hash
;

interface route
{
	function httpRouteControllerHasRequest(route\controller $controller, request $request);
	function recipientOfHttpUrlPathIs(url\path\recipient $recipient);
}
