<?php namespace estvoyage\risingsun\tests\units\comparison;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\comparison as mockOfComparison;

abstract class unary extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\unary')
		;
	}

	/**
	 * @dataProvider okProvider
	 */
	function testRecipientOfComparisonWithOperandIs_withOKOperandForReference($operand, $reference)
	{
		$this
			->given(
				$this->newTestedInstance($reference),
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->testedInstance->recipientOfComparisonWithOperandIs($operand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($reference))
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(true)
							->once
		;
	}

	/**
	 * @dataProvider koProvider
	 */
	function testRecipientOfComparisonWithOperandIs_withKoOperandForReference($operand, $reference)
	{
		$this
			->given(
				$this->newTestedInstance($reference),
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->testedInstance->recipientOfComparisonWithOperandIs($operand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($reference))
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(false)
							->once
		;
	}

	protected abstract function okProvider();

	protected abstract function koProvider();
}
