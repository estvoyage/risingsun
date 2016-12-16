<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun\http\url,
	estvoyage\risingsun\http\route,
	estvoyage\risingsun\http\request
;

interface hash extends route
{
	function recipientOfHttpRouteHashWithRouteIs(route $route, hash\recipient $recipient);
	function recipientOfHttpRouteWithPathIs(url\path $path, hash\route\recipient $recipient);
}
