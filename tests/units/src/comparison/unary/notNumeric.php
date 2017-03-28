<?php namespace estvoyage\risingsun\tests\units\comparison\unary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\oboolean as mockOfOBoolean;

class notNumeric extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\unary')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new oboolean\ok, new oboolean\ko));
	}

	/**
	 * @dataProvider numericProvider
	 */
	function testRecipientOfComparisonWithValueIs_withNumeric($value)
	{
		$this
			->given(
				$ok = new mockOfOBoolean,
				$ko = new mockOfOBoolean,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance($ok, $ko)
			)
			->then
				->object($this->testedInstance->recipientOfComparisonWithValueIs($value, $recipient))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($ko)
							->once
		;
	}

	/**
	 * @dataProvider notNumericProvider
	 */
	function testRecipientOfComparisonWithValueIs_withNotNumeric($value)
	{
		$this
			->given(
				$ok = new mockOfOBoolean,
				$ko = new mockOfOBoolean,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance($ok, $ko)
			)
			->then
				->object($this->testedInstance->recipientOfComparisonWithValueIs($value, $recipient))
					->isEqualTo($this->newTestedInstance($ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($ok)
							->once
		;
	}

	protected function numericProvider()
	{
		return [
			0,
			'0',
			0.,
			'0.',
			rand(- PHP_INT_MAX, PHP_INT_MAX),
			(string) rand(- PHP_INT_MAX, PHP_INT_MAX),
			M_PI,
			(string) M_PI,
			1e9,
			'1e9',
			-1e9,
			'-1e9',
			0x539,
			02471,
			'02471',
			0b10100111001
		];
	}

	protected function notNumericProvider()
	{
		return [
			'- 1e9',
			'0x539',
			'0b10100111001',
			[ [] ],
			new \stdClass
		];
	}
}
