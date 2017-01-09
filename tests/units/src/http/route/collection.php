<?php namespace estvoyage\risingsun\tests\units\http\route;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{http as mockOfHttp};

class collection extends units\test
{
	function testPayloadForIteratorIs()
	{
		$this
			->given(
				$route1 = new mockOfHttp\route,
				$route2 = new mockOfHttp\route,
				$iterator = new mockOfHttp\route\collection\iterator,
				$payload = new mockOfHttp\route\collection\payload
			)
			->if(
				$this->newTestedInstance($route1, $route2)
			)
			->then
				->object($this->testedInstance->payloadForIteratorIs($iterator, $payload))
					->isEqualTo($this->newTestedInstance($route1, $route2))
				->mock($iterator)
					->receive('httpRoutesForPayloadAre')
						->withArguments($payload, $route1, $route2)
							->once
		;
	}
}
