<?php namespace estvoyage\risingsun\http\request;

use
	estvoyage\risingsun\http
;

interface recipient
{
	function httpRequestIs(http\request $request);
}
