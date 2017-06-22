<?php namespace estvoyage\risingsun\tests\units\comparison\unary\with\null;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\comparison as mockOfComparison;

class type extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\unary')
		;
	}

	function testRecipientOfComparisonWithOperandIs()
	{
		$this
			->given(
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->newTestedInstance->recipientOfComparisonWithOperandIs(null, $recipient)
			)
			->then
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(true)
							->once
		;
	}

	/**
	 * @dataProvider notNullProvider
	 */
	function testRecipientOfComparisonWithOperandIs_withNotNullOperand($operand)
	{
		$this
			->given(
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->newTestedInstance->recipientOfComparisonWithOperandIs($operand, $recipient)
			)
			->then
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(false)
							->once
		;
	}

	protected function notNullProvider()
	{
		return [
			0,
			rand(PHP_INT_MIN, -1),
			rand(1, PHP_INT_MAX),
			false,
			true,
			0.,
			M_PI,
			- M_PI,
			'',
			uniqid(),
			new \stdClass
		];
	}
}
