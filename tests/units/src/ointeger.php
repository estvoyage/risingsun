<?php namespace estvoyage\risingsun\tests\units;

require __DIR__ . '/../runner.php';

use
	estvoyage\risingsun,
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\block as mockOfBlock
;

class ointeger extends units\test
{
	function testWithNoValue()
	{
		$this
			->castToString($this->newTestedInstance)->isEqualTo('0')
			->integer($this->newTestedInstance->value)->isZero
		;
	}

	/**
	 * @dataProvider validValueProvider
	 */
	function testWithValue($value)
	{
		$this
			->object($this->newTestedInstance($value))
				->castToString($this->testedInstance)
					->isEqualTo((int) $value)
			->integer($this->testedInstance->value)->isEqualTo((int) $value)
		;
	}

	/**
	 * @dataProvider invalidValueProvider
	 */
	function testWithInvalidValue($value)
	{
		$this
			->exception(function() use ($value) { new risingsun\ointeger($value); })
				->isInstanceOf('domainException')
				->hasMessage('Value should be an integer')
		;
	}

	function testIfIsLessThan()
	{
		$this
			->given(
				$isLessThanBlock = new mockOfBlock
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifIsLessThan($this->newTestedInstance, $isLessThanBlock))
					->isEqualTo($this->newTestedInstance)
				->mock($isLessThanBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->never

			->if(
				$this->newTestedInstance(-1)
			)
				->object($this->testedInstance->ifIsLessThan($this->newTestedInstance, $isLessThanBlock))
					->isEqualTo($this->newTestedInstance(-1))
				->mock($isLessThanBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->given(
				$isNotLessThanBlock = new mockOfBlock
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifIsLessThan($this->newTestedInstance(-1), $isLessThanBlock, $isNotLessThanBlock))
					->isEqualTo($this->newTestedInstance)
				->mock($isLessThanBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
				->mock($isNotLessThanBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}

	function testIfIsEqualTo()
	{
		$this
			->given(
				$isEqualToBlock = new mockOfBlock
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifIsEqualTo($this->testedInstance, $isEqualToBlock))->isTestedInstance
				->mock($isEqualToBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->if(
				$this->newTestedInstance(-1)
			)
			->then
				->object($this->testedInstance->ifIsEqualTo($this->newTestedInstance, $isEqualToBlock))
				->mock($isEqualToBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->given(
				$isNotEqualToBlock = new mockOfBlock
			)
			->if(
				$this->newTestedInstance(-1)
			)
			->then
				->object($this->testedInstance->ifIsEqualTo($this->newTestedInstance, $isEqualToBlock, $isNotEqualToBlock))
				->mock($isEqualToBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
				->mock($isNotEqualToBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}

	function testWhileIsGreaterThan()
	{
		$this
			->given(
				$integer = $this->newTestedInstance,
				$block = new mockOfBlock
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->whileIsGreaterThan($this->newTestedInstance, $block))
					->isEqualTo($this->newTestedInstance)
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments()
							->never

			->if(
				$this->newTestedInstance(1)
			)
			->then
				->object($this->testedInstance->whileIsGreaterThan($this->newTestedInstance, $block))
					->isEqualTo($this->newTestedInstance(1))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->if(
				$this->newTestedInstance(2)
			)
			->then
				->object($this->testedInstance->whileIsGreaterThan($this->newTestedInstance, $block))
					->isEqualTo($this->newTestedInstance(2))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments()
							->thrice
		;
	}

	function testWhileIsGreaterThanZero()
	{
		$this
			->given(
				$block = new mockOfBlock
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->whileIsGreaterThanZero($block))
					->isEqualTo($this->newTestedInstance)
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments()
							->never

			->if(
				$this->newTestedInstance(1)
			)
			->then
				->object($this->testedInstance->whileIsGreaterThanZero($block))
					->isEqualTo($this->newTestedInstance(1))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}

	protected function validValueProvider()
	{
		return [
			0,
			rand(- PHP_INT_MAX, -1),
			rand(1, PHP_INT_MAX),
			0.,
			(float) rand(- PHP_INT_MAX, -1),
			(float) rand(1, PHP_INT_MAX)
		];
	}

	protected function invalidValueProvider()
	{
		return [
			true,
			false,
			null,
			'foo' . uniqid(),
			M_PI,
			[ [] ],
			new \stdclass
		];
	}
}
