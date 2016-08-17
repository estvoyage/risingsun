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

	function testAddendIsInteger()
	{
		$this
			->given(
				$addend = new risingsun\ointeger
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->addendIsInteger($addend))
					->isNotTestedInstance
					->isEqualTo($this->newTestedInstance)

			->given(
				$addend = new risingsun\ointeger(1)
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->addendIsInteger($addend))
					->isEqualTo($this->newTestedInstance(1.))

			->given(
				$float = M_PI
			)
			->if(
				$this->newTestedInstance($float)
			)
			->then
				->object($this->testedInstance->addendIsInteger($addend))
					->isEqualTo($this->newTestedInstance(M_PI + 1))
		;
	}

	function testAddendIsFloat()
	{
		$this
			->given(
				$addend = $this->newTestedInstance
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->addendIsFloat($addend))
					->isNotTestedInstance
					->isEqualTo($this->newTestedInstance)

			->given(
				$addend = $this->newTestedInstance(1.)
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->addendIsFloat($addend))
					->isEqualTo($this->newTestedInstance(1.))

			->given(
				$float = M_PI
			)
			->if(
				$this->newTestedInstance($float)
			)
			->then
				->object($this->testedInstance->addendIsFloat($addend))
					->isEqualTo($this->newTestedInstance(M_PI + 1.))
		;
	}

	function testFactorIsFloat()
	{
		$this
			->given(
				$factor = $this->newTestedInstance
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->factorIsFloat($factor))
					->isNotTestedInstance
					->isEqualTo($this->newTestedInstance)

			->given(
				$factor = $this->newTestedInstance(2.0)
			)
			->if(
				$this->newTestedInstance(2.0)
			)
			->then
				->object($this->testedInstance->factorIsFloat($factor))
					->isNotTestedInstance
					->isEqualTo($this->newTestedInstance(4.0))
		;
	}

	function testFactorIsInteger()
	{
		$this
			->given(
				$factor = new risingsun\ointeger
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->factorIsInteger($factor))
					->isNotTestedInstance
					->isEqualTo($this->newTestedInstance)

			->given(
				$factor = new risingsun\ointeger(2)
			)
			->if(
				$this->newTestedInstance(2.0)
			)
			->then
				->object($this->testedInstance->factorIsInteger($factor))
					->isNotTestedInstance
					->isEqualTo($this->newTestedInstance(4.0))
		;
	}

	function testDivisorIsInteger()
	{
		$this
			->given(
				$divisor = new risingsun\ointeger\divisor(rand(1, PHP_INT_MAX))
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->divisorIsInteger($divisor))
					->isNotTestedInstance
					->isEqualTo($this->newTestedInstance)

			->given(
				$divisor = new risingsun\ointeger\divisor(2)
			)
			->if(
				$this->newTestedInstance(4.)
			)
			->then
				->object($this->testedInstance->divisorIsInteger($divisor))
					->isNotTestedInstance
					->isEqualTo($this->newTestedInstance(2.))
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
