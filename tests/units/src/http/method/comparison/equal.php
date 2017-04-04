<?php namespace estvoyage\risingsun\tests\units\http\method\comparison;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\{ http as mockOfHttp, block as mockOfBlock };

class equal extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\http\method\comparison')
		;
	}

	function testReferenceForComparisonWithHttpMethodIs()
	{
		$this
			->given(
				$ok = new mockOfBlock,
				$ko = new mockOfBlock,
				$method = new mockOfHttp\method,
				$reference = new mockOfHttp\method
			)
			->if(
				$this->newTestedInstance($ok, $ko)
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithHttpMethodIs($method, $reference))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->never
				->mock($ko)
					->receive('blockArgumentsAre')
						->never

			->given(
				$this->calling($method)->recipientOfHttpMethodValueIs = function($recipient) use (& $methodValue) {
					$recipient->nstringIs($methodValue);
				}
			)
			->if(
				$methodValue = uniqid()
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithHttpMethodIs($method, $reference))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->never
				->mock($ko)
					->receive('blockArgumentsAre')
						->never

			->given(
				$this->calling($reference)->recipientOfHttpMethodValueIs = function($recipient) use (& $referenceValue) {
					$recipient->nstringIs($referenceValue);
				}
			)
			->if(
				$referenceValue = $methodValue
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithHttpMethodIs($method, $reference))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->once
				->mock($ko)
					->receive('blockArgumentsAre')
						->never

			->if(
				$referenceValue = uniqid()
			)
			->then
				->object($this->testedInstance->referenceForComparisonWithHttpMethodIs($method, $reference))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->once
				->mock($ko)
					->receive('blockArgumentsAre')
						->once
		;
	}
}
