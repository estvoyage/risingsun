<?php namespace estvoyage\risingsun\http\request\endpoint;

use
	estvoyage\risingsun\http
;

interface recipient
{
	function httpRequestEndpointIs(http\request\endpoint $endpoint);
}
