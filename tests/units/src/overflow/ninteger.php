<?php namespace estvoyage\risingsun\tests\units\overflow;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\comparison as mockOfComparison;

class ninteger extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\overflow')
		;
	}

	/**
	 * @dataProvider invalidValueProvider
	 */
	function testRecipientOfComparisonBetweenValueAndRangeIs_withInvalidValue($value)
	{
		$this
			->given(
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->newTestedInstance->recipientOfComparisonBetweenValueAndRangeIs($value, $recipient)
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
	 * @dataProvider validValueProvider
	 */
	function testRecipientOfComparisonBetweenValueAndRangeIs_withValidValue($value, $nboolean)
	{
		$this
			->given(
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->newTestedInstance->recipientOfComparisonBetweenValueAndRangeIs($value, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments($nboolean)
							->once
		;
	}

	protected function validValueProvider()
	{
		return [
			[ PHP_INT_MIN, true ],
			[ PHP_INT_MAX, true ],
			[ rand(PHP_INT_MIN + 1, PHP_INT_MAX - 1), true ],
			[ PHP_INT_MIN - 1, false ],
			[ PHP_INT_MAX + 1, false ]
		];
	}

	protected function invalidValueProvider()
	{
		return [
			'foobar',
			null,
			'',
			new \stdClass
		];
	}
}
