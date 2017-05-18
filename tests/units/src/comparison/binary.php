<?php namespace estvoyage\risingsun\tests\units\comparison;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\comparison as mockOfComparison;

abstract class binary extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\binary')
		;
	}

	/**
	 * @dataProvider okProvider
	 */
	function testRecipientOfComparisonBetweenOperandAndReferenceIs_withOkOperandForReference($operand, $reference)
	{
		$this
			->given(
				$this->newTestedInstance,
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->testedInstance->recipientOfComparisonBetweenOperandAndReferenceIs($operand, $reference, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nbooleanIs')
						->once
						->withArguments(true)
							->once
		;
	}

	/**
	 * @dataProvider koProvider
	 */
	function testRecipientOfComparisonBetweenOperandAndReferenceIs_withKoOperandForReference($operand, $reference)
	{
		$this
			->given(
				$this->newTestedInstance,
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->testedInstance->recipientOfComparisonBetweenOperandAndReferenceIs($operand, $reference, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nbooleanIs')
						->once
						->withArguments(false)
							->once
		;
	}

	protected abstract function okProvider();

	protected abstract function koProvider();
}
