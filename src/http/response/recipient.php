<?php namespace estvoyage\risingsun\http\response;

use
	estvoyage\risingsun\http
;

interface recipient
{
	function httpResponseIs(http\response $response);
}
