<?php namespace estvoyage\risingsun\tests\units\ninteger\filter;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, block };
use mock\estvoyage\risingsun\{ ninteger as mockOfNInteger, block as mockOfBlock };

class type extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ninteger\filter')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new block\blackhole));
	}

	/**
	 * @dataProvider nIntegerProvider
	 */
	function testNIntegerRecipientOfValueIs_withNInteger($value)
	{
		$this
			->given(
				$this->newTestedInstance($block = new mockOfBlock),
				$recipient = new mockOfNInteger\recipient
			)
			->if(
				$this->testedInstance->nIntegerRecipientForValueIs($value, $recipient)
			)
			->then
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
	 * @dataProvider notNIntegerProvider
	 */
	function testNIntegerRecipientOfValueIs_withNotNIntegerValue($value)
	{
		$this
			->given(
				$this->newTestedInstance($block = new mockOfBlock),
				$recipient = new mockOfNInteger\recipient
			)
			->if(
				$this->testedInstance->nIntegerRecipientForValueIs($value, $recipient)
			)
			->then
				->mock($recipient)
					->receive('nintegerIs')
						->never
				->mock($block)
					->receive('blockArgumentsAre')
						->once
		;
	}

	protected function nIntegerProvider()
	{
		return [
			rand(PHP_INT_MIN, PHP_INT_MAX)
		];
	}

	protected function notNIntegerProvider()
	{
		return [
			'',
			uniqid(),
			true,
			false,
			null,
			[ [] ],
			M_PI,
			- M_PI,
			(string) rand(PHP_INT_MIN, PHP_INT_MAX),
			new \stdClass
		];
	}
}
