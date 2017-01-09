<?php namespace estvoyage\risingsun\http\route\collection\iterator;

use estvoyage\{ risingsun, risingsun\http, risingsun\block };

class fifo
	implements
		http\route\collection\iterator
{
	private
		$iterator
	;

	function __construct()
	{
		$this->iterator = new risingsun\iterator\fifo;
	}

	function httpRoutesForPayloadAre(http\route\collection\payload $payload, http\route... $routes)
	{
		$this->iterator->iteratorPayloadForValuesIs($routes, new block\functor(function($iterator, $route) use ($payload) {
					$payload->currentHttpRouteOfIteratorIs($iterator, $route);
				}
			)
		);

		return $this;
	}
}
