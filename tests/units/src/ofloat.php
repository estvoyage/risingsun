<?php namespace estvoyage\risingsun\tests\units;

require __DIR__ . '/../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun,
	mock\estvoyage\risingsun\ofloat as mockOfOfloat
;

class ofloat extends units\test
{
	function testWithNoValue()
	{
		$this
			->castToString($this->newTestedInstance)->isEqualTo('0.0')
			->float($this->newTestedInstance->value)->isZero
		;
	}

	function testWithFloat()
	{
		$this
			->given(
				$float = M_PI
			)
			->if(
				$this->newTestedInstance($float)
			)
			->then
				->castToString($this->testedInstance)->isEqualTo((string) $float)
				->float($this->testedInstance->value)->isEqualTo($float)
		;
	}

	/**
	 * @dataProvider invalidValueProvider
	 */
	function testWithInvalidValue($value)
	{
		$this
			->exception(function() use ($value) { $this->newTestedInstance($value); })
				->isInstanceOf('domainException')
				->hasMessage('Value should be a float')
		;
	}

	function testRecipientOfDecimalPartIs()
	{
		$this
			->given(
				$recipient = new mockOfOfloat\part\decimal\recipient,
				$precision = new risingsun\ofloat\part\decimal\precision(3)
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfDecimalPartWithPrecisionIs($precision, $recipient))->isTestedInstance
				->mock($recipient)
					->receive('decimalPartIs')
						->withArguments(new risingsun\ofloat\part\decimal)
							->once

			->given(
				$this->newTestedInstance(145.073301)
			)
			->if(
				$this->testedInstance->recipientOfDecimalPartWithPrecisionIs($precision, $recipient)
			)
			->then
				->mock($recipient)
					->receive('decimalPartIs')
						->withArguments(new risingsun\ofloat\part\decimal(73))
							->once
		;
	}

	function testRecipientOfIntegralPartIs()
	{
		$this
			->given(
				$recipient = new mockOfOfloat\part\integral\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfIntegralPartIs($recipient))->isTestedInstance
				->mock($recipient)
					->receive('integralPartIs')
						->withArguments(new risingsun\ofloat\part\integral)
							->once

			->given(
				$this->newTestedInstance(145.073301)
			)
			->if(
				$this->testedInstance->recipientOfIntegralPartIs($recipient)
			)
			->then
				->mock($recipient)
					->receive('integralPartIs')
						->withArguments(new risingsun\ofloat\part\integral(145))
							->once
		;
	}

	function testRecipientOfFloatWithAddendIs()
	{
		$this
			->given(
				$recipient = new mockOfOfloat\addition\recipient,
				$addend = $this->newTestedInstance
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfFloatWithAddendIs($addend, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ofloatWithAddendIs')
						->withArguments($this->newTestedInstance)
							->once

			->given(
				$addend = $this->newTestedInstance(1.0)
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfFloatWithAddendIs($addend, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ofloatWithAddendIs')
						->withArguments($addend)
							->once
		;
	}

	protected function validValueProvider()
	{
		return [
			0.,
			(float) rand(- PHP_INT_MAX, PHP_INT_MAX),
			M_PI
		];
	}

	protected function invalidValueProvider()
	{
		return [
			true,
			false,
			null,
			'foo' . uniqid(),
			[ [] ],
			new \stdclass
		];
	}
}
