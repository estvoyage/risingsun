<?php namespace estvoyage\risingsun\tests\units\comparison\unary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\comparison as mockOfComparison;

class blank extends units\test
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
	function testRecipientOfComparisonWithOperandIs_withOkOperand($operand)
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

	protected function okProvider()
	{
		return [
			'',
			null,
			false,
			0,
			0.
		];
	}

	protected function koProvider()
	{
		return [
			'foo',
			[ uniqid() ],
			true,
			new \stdClass,
			rand(1, PHP_INT_MAX),
			rand(PHP_INT_MIN, -1),
			- M_PI,
			M_PI,
			[ [] ],
			'0',
			'0.'
		];
	}
}
