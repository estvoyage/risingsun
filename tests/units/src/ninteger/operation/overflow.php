<?php namespace estvoyage\risingsun\tests\units\ninteger\operation;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, block };
use mock\estvoyage\risingsun\{ block as mockOfBlock, ninteger as mockOfNInteger };

class overflow extends units\test
{
	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new block\blackhole));
	}

	/**
	 * @dataProvider notOverflowProvider
	 */
	function testValueFromOperationWithNIntegerRecipientIs_withNoOverflow($value)
	{
		$this
			->given(
				$block = new mockOfBlock,
				$recipient = new mockOfNInteger\recipient
			)
			->if(
				$this->newTestedInstance($block)
			)
			->then
				->object($this->testedInstance->valueFromOperationWithNIntegerRecipientIs($recipient, $value))
					->isEqualTo($this->newTestedInstance($block))
				->mock($recipient)
					->receive('nintegerIs')
						->withArguments($value)
							->once
				->mock($block)
					->receive('blockArgumentsAre')
						->never
		;
	}

	/**
	 * @dataProvider overflowProvider
	 */
	function testValueFromOperationWithNIntegerRecipientIs_withOverflow($value)
	{
		$this
			->given(
				$block = new mockOfBlock,
				$recipient = new mockOfNInteger\recipient
			)
			->if(
				$this->newTestedInstance($block)
			)
			->then
				->object($this->testedInstance->valueFromOperationWithNIntegerRecipientIs($recipient, $value))
					->isEqualTo($this->newTestedInstance($block))
				->mock($recipient)
					->receive('nintegerIs')
						->never
				->mock($block)
					->receive('blockArgumentsAre')
						->once
		;
	}

	/**
	 * @dataProvider invalidValueProvider
	 */
	function testValueFromOperationWithNIntegerRecipientIs_withInvalidValue($value)
	{
		$this
			->given(
				$block = new mockOfBlock,
				$recipient = new mockOfNInteger\recipient
			)
			->if(
				$this->newTestedInstance($block)
			)
			->then
				->object($this->testedInstance->valueFromOperationWithNIntegerRecipientIs($recipient, $value))
					->isEqualTo($this->newTestedInstance($block))
				->mock($recipient)
					->receive('nintegerIs')
						->never
				->mock($block)
					->receive('blockArgumentsAre')
						->never
		;
	}

	protected function notOverflowProvider()
	{
		return [
			rand(PHP_INT_MIN, -1),
			0,
			rand(1, PHP_INT_MAX),
			0b0,
			0x0
		];
	}

	protected function overflowProvider()
	{
		return [
			PHP_INT_MAX + 1,
			PHP_INT_MIN - PHP_INT_MAX
		];
	}

	protected function invalidValueProvider()
	{
		return [
			(string) rand(PHP_INT_MIN, -1),
			(string) rand(1, PHP_INT_MAX),
			0.,
			'0',
			'0.',
			M_PI,
			(string) M_PI,
			- M_PI,
			'-' . M_PI,
			false,
			true,
			'foo',
			null,
			new \stdClass
		];
	}
}
