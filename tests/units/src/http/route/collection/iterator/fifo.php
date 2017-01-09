<?php namespace estvoyage\risingsun\tests\units\http\route\collection\iterator;

require __DIR__ . '/../../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\http as mockOfHttp
;

class fifo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\http\route\collection\iterator')
		;
	}

	function testHttpRoutesForPayloadAre()
	{
		$this
			->given(
				$payload = new mockOfHttp\route\collection\payload,
				$this->calling($payload)->currentHttpRouteOfIteratorIs = function($anIterator, $aRoute) use (& $routes) {
					$routes[] = $aRoute;
				},
				$route1 = new mockOfHttp\route,
				$route2 = new mockOfHttp\route
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->httpRoutesForPayloadAre($payload, $route1, $route2))
					->isEqualTo($this->newTestedInstance)
				->array($routes)->isEqualTo([ $route1, $route2 ])
		;
	}
}
