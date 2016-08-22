<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun\http
;

interface controller
{
	function httpResponseIs(http\response $response);
}
