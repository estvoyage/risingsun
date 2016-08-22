<?php namespace estvoyage\risingsun\http\method;

use
	estvoyage\risingsun\http
;

interface recipient
{
	function httpMethodIs(http\method $method);
}
