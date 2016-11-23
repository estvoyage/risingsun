<?php namespace estvoyage\risingsun\http\route\hash\route;

use
	estvoyage\risingsun\http
;

interface recipient
{
	function httpRouteWithPathIs(http\route $route);
}
