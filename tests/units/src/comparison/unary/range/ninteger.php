<?php namespace estvoyage\risingsun\tests\units\comparison\unary\range;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\comparison as mockOfComparison;

class ninteger extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\unary')
		;
	}

	/**
	 * @dataProvider invalidValueProvider
	 */
	function testRecipientOfComparisonWithOperandIs_withInvalidValue($value)
	{
		$this
			->given(
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->newTestedInstance->recipientOfComparisonWithOperandIs($value, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nbooleanIs')
						->never
		;
	}

	/**
	 * @dataProvider inRangeProvider
	 */
	function testRecipientOfComparisonWithOperandIs_withInRangeValue($value)
	{
		$this
			->given(
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->newTestedInstance->recipientOfComparisonWithOperandIs($value, $recipient)
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
	 * @dataProvider outOfRangeProvider
	 */
	function testRecipientOfComparisonWithOperandIs_withOutOfRangeValue($value)
	{
		$this
			->given(
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->newTestedInstance->recipientOfComparisonWithOperandIs($value, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(false)
							->once
						->withArguments(true)
							->never
		;
	}

	protected function inRangeProvider()
	{
		return [
			PHP_INT_MIN,
			PHP_INT_MAX,
			rand(PHP_INT_MIN + 1, PHP_INT_MAX - 1)
		];
	}

	protected function outOfRangeProvider()
	{
		return [
			PHP_INT_MIN - 1,
			PHP_INT_MAX + 1,
			M_PI,
			-M_PI
		];
	}

	protected function invalidValueProvider()
	{
		return [
			true,
			false,
			'foobar',
			'',
			null,
			new \stdClass
		];
	}
}
