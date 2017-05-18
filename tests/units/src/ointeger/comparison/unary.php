<?php namespace estvoyage\risingsun\tests\units\ointeger\comparison;

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, comparison as mockOfComparison };

abstract class unary extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\comparison\unary')
		;
	}

	/**
	 * @dataProvider provider
	 */
	function testOIntegerForComparisonIs_BooleanForOperandAndReferenceIs($integer, $reference, $boolean)
	{
		$this
			->given(
				$oInteger = new mockOfOInteger,
				$this->calling($oInteger)->recipientOfNIntegerIs = function($recipient) use ($integer) {
					$recipient->nintegerIs($integer);
				},

				$oReference = new mockOfOInteger,
				$this->calling($oReference)->recipientOfNIntegerIs = function($recipient) use ($reference) {
					$recipient->nintegerIs($reference);
				},

				$recipient = new mockOfComparison\recipient,

				$this->newTestedInstance($oReference)
			)
			->if(
				$this->testedInstance->recipientOfComparisonWithOIntegerIs($oInteger, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($oReference))
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments($boolean)
							->once
		;
	}

	protected abstract function provider();
}
