<?php namespace estvoyage\risingsun\tests\units\comparison\unary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\oboolean as mockOfOBoolean;

class isFloat extends units\test
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
	 * @dataProvider invalidValueProvider
	 */
	function testRecipientOfComparisonWithValueIs_withInvalidValue($value)
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
						->withArguments($ok)
							->never
		;
	}

	/**
	 * @dataProvider validValueProvider
	 */
	function testRecipientOfComparisonWithValueIs_withValidValue($value)
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
						->withArguments($ko)
							->never
		;
	}

	protected function validValueProvider()
	{
		return [
			0.,
			1.,
			M_PI
		];
	}

	protected function invalidValueProvider()
	{
		return [
			0,
			'0',
			rand(- PHP_INT_MAX, -1),
			(string) rand(- PHP_INT_MAX, -1),
			rand(1, PHP_INT_MAX),
			(string) rand(1, PHP_INT_MAX),
			false,
			true,
			'foo',
			new \stdClass,
			(string) M_PI
		];
	}
}
