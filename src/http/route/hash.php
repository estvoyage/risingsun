<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun\hash\key,
	estvoyage\risingsun\http\route,
	estvoyage\risingsun\http\request
;

interface hash extends route
{
	function recipientOfHttpRouteHashWithRouteIs(route $route, hash\recipient $recipient);
	function recipientOfHttpRouteAtKeyIs(key $key, hash\route\recipient $recipient);
	function httpRouteControllerHasRequest(route\controller $controller, request $request);
}
