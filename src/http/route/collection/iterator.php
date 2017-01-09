<?php namespace estvoyage\risingsun\http\route\collection;

use
	estvoyage\risingsun\http
;

interface iterator
{
	function httpRoutesForPayloadAre(payload $payload, http\route... $routes);
}
