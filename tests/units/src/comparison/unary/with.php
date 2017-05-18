<?php namespace estvoyage\risingsun\tests\units\comparison\unary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\comparison as mockOfComparison;

abstract class with extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\unary')
		;
	}

	/**
	 * @dataProvider koProvider
	 */
	function testRecipientOfComparisonWithOperandIs_withKoOperand($operand)
	{
		$this
			->given(
				$this->newTestedInstance,
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->testedInstance->recipientOfComparisonWithOperandIs($operand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(false)
							->once
		;
	}

	/**
	 * @dataProvider okProvider
	 */
	function testRecipientOfComparisonWithOperandIs_withOKOperand($operand)
	{
		$this
			->given(
				$this->newTestedInstance,
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->testedInstance->recipientOfComparisonWithOperandIs($operand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(true)
							->once
		;
	}

	protected abstract function okProvider();

	protected abstract function koProvider();
}
