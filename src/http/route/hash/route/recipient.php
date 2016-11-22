<?php namespace estvoyage\risingsun\http\route\hash\route;

use
	estvoyage\risingsun\http
;

interface recipient
{
	function hashKeyHasHttpRoute(http\route $route);
}
