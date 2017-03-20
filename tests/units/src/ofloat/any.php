<?php namespace estvoyage\risingsun\tests\units\ofloat;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ nfloat as mockOfNFloat, ofloat as mockOfOFloat };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ofloat')
		;
	}

	function testWithNoValue()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(0));
	}

	function testRecipientOfOIntegerWithNFloatIs()
	{
		$this
			->given(
				$value = (float) rand(- PHP_INT_MAX, PHP_INT_MAX),
				$recipient = new mockOfOFloat\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfOFloatWithNFloatIs($value, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ofloatIs')
						->withArguments($this->newTestedInstance($value))
							->once

			->if(
				$childOfTestedClass = new childOfTestedClass
			)
			->then
				->object($childOfTestedClass->recipientOfOFloatWithNFloatIs($value, $recipient))
					->isEqualTo($childOfTestedClass)
				->mock($recipient)
					->receive('ofloatIs')
						->withArguments(new childOfTestedClass($value))
							->once
		;
	}

	/**
	 * @dataProvider invalidValueProvider
	 */
	function testWithInvalidValue($value)
	{
		$this
			->exception(function() use ($value) { $this->newTestedInstance($value); })
				->isInstanceOf('typeError')
				->hasMessage('Value should be a float')
		;
	}

	/**
	 * @dataProvider validValueProvider
	 */
	function testRecipientOfNFloatIs($value)
	{
		$this
			->given(
				$recipient = new mockOfNFloat\recipient
			)
			->if(
				$this->newTestedInstance($value)
			)
			->then
				->object($this->testedInstance->recipientOfNFloatIs($recipient))
					->isEqualTo($this->newTestedInstance($value))
				->mock($recipient)
					->receive('nfloatIs')
						->withIdenticalArguments((float) $value)
							->once
		;
	}

	protected function validValueProvider()
	{
		return [
			0,
			0.,
			rand(1, PHP_INT_MAX),
			rand(- PHP_INT_MAX, -1),
			(string) rand(- PHP_INT_MAX, -1),
			M_PI,
			- M_PI,
			(string) - M_PI
			- 1e9,
			1e9,
			'0',
			'0.',
			(string) rand(1, PHP_INT_MAX),
			(string) M_PI,
			'1e9',
		];
	}

	protected function invalidValueProvider()
	{
		return [
			null,
			true,
			false,
			'foobar',
			new \stdclass
		];
	}

	protected function validNStringProvider()
	{
		return [
			'0',
			'0.',
			(string) rand(1, PHP_INT_MAX),
			(string) M_PI,
			'1e9'
		];
	}

}
