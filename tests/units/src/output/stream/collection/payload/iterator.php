<?php namespace estvoyage\risingsun\tests\units\output\stream\collection\payload;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ iterator as mockOfIterator, output as mockOfOutput };

class iterator extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\output\stream\collection\payload')
			->implements('estvoyage\risingsun\iterator\payload')
		;
	}

	function testCurrentValueOfIteratorIs()
	{
		$this
			->given(
				$iterator = new mockOfIterator,
				$stream = new mockOfOutput\stream,
				$payload = new mockOfOutput\stream\collection\payload
			)
			->if(
				$this->newTestedInstance($payload)
			)
			->then
				->object($this->testedInstance->currentValueOfIteratorIs($iterator, $stream))
					->isEqualTo($this->newTestedInstance($payload))
				->mock($payload)
					->receive('currentStreamOfIteratorIs')
						->withArguments($iterator, $stream)
							->once

			->given(
				$value = uniqid()
			)
			->then
				->exception(function() use ($iterator, $value) {
						$this->testedInstance->currentValueOfIteratorIs($iterator, $value);
					}
				)
					->isInstanceOf('TypeError')
		;
	}

	function testCurrentStreamOfIteratorIs()
	{
		$this
			->given(
				$iterator = new mockOfIterator,
				$stream = new mockOfOutput\stream,
				$payload = new mockOfOutput\stream\collection\payload
			)
			->if(
				$this->newTestedInstance($payload)
			)
			->then
				->object($this->testedInstance->currentStreamOfIteratorIs($iterator, $stream))
					->isEqualTo($this->newTestedInstance($payload))
				->mock($payload)
					->receive('currentStreamOfIteratorIs')
						->withArguments($iterator, $stream)
							->once
		;
	}
}
