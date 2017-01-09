<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http
;

class collection
{
	private
		$routes
	;

	function __construct(http\route... $routes)
	{
		$this->routes = $routes;
	}

	function payloadForIteratorIs(collection\iterator $iterator, collection\payload $payload)
	{
		$iterator->httpRoutesForPayloadAre($payload, ... $this->routes);

		return $this;
	}
}
