<?php namespace estvoyage\risingsun\tests\units\time\duration\timestamp\unix;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\nfloat as mockOfNFloat;

class micro extends units\test
{
	/**
	 * @dataProvider invalidValueProvider
	 */
	function testWithInvalidValue($value)
	{
		$this
			->exception(function() use ($value) { $this->newTestedInstance($value); })
				->isInstanceOf('typeError')
				->hasMessage('Value should be an unsigned float')
		;
	}

	/**
	 * @dataProvider validValueProvider
	 */
	function testRecipientOfNFloat($value)
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
			M_PI,
			'0',
			'0.',
			(string) rand(1, PHP_INT_MAX),
			(string) M_PI,
			1e9
		];
	}

	protected function invalidValueProvider()
	{
		return [
			null,
			true,
			false,
			'foobar',
			new \stdclass,
			rand(- PHP_INT_MAX, -1),
			(string) rand(- PHP_INT_MAX, -1),
			- M_PI,
			(string) - M_PI
			- 1e9
		];
	}
}
