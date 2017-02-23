<?php namespace estvoyage\risingsun\tests\units\ointeger\comparison;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, oboolean as mockOfOBoolean, block as mockOfBlock };

class equal extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\comparison\binary')
		;
	}

	function testWithNoValue()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new oboolean\ok));
	}

	function testRecipientOfOIntegerComparisonBetweenOIntegerIs()
	{
		$this
			->given(
				$oboolean = new mockOfOBoolean,
				$firstOperand = new mockOfOInteger,
				$secondOperand = new mockOfOInteger,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance($oboolean)
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($oboolean))
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->if(
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(2);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($oboolean))
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->if(
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(2);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($oboolean))
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->if(
				$equal = new mockOfOBoolean,

				$this->calling($oboolean)->recipientOfOBooleanWithValueIs = function($value, $recipient) use ($equal) {
					if ($value)
					{
						$recipient->obooleanIs($equal);
					}
				}
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($oboolean))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($equal)
							->once
		;
	}

	function testBlockForOIntegerComparisonBetweenOIntegerIs()
	{
		$this
			->given(
				$oboolean = new mockOfOBoolean,
				$firstOperand = new mockOfOInteger,
				$secondOperand = new mockOfOInteger,
				$block = new mockOfBlock
			)
			->if(
				$this->newTestedInstance($oboolean)
			)
			->then
				->object($this->testedInstance->blockForOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $block))
					->isEqualTo($this->newTestedInstance($oboolean))
				->mock($block)
					->receive('blockArgumentsAre')
						->never

			->if(
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(2);
				}
			)
			->then
				->object($this->testedInstance->blockForOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $block))
					->isEqualTo($this->newTestedInstance($oboolean))
				->mock($block)
					->receive('blockArgumentsAre')
						->never

			->if(
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(2);
				}
			)
			->then
				->object($this->testedInstance->blockForOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $block))
					->isEqualTo($this->newTestedInstance($oboolean))
				->mock($block)
					->receive('blockArgumentsAre')
						->never

			->if(
				$equal = new mockOfOBoolean,

				$this->calling($oboolean)->recipientOfOBooleanWithValueIs = function($value, $recipient) use ($equal) {
					if ($value)
					{
						$recipient->obooleanIs($equal);
					}
				}
			)
			->then
				->object($this->testedInstance->blockForOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $block))
					->isEqualTo($this->newTestedInstance($oboolean))
				->mock($block)
					->receive('blockArgumentsAre')
						->never

			->if(
				$this->calling($equal)->blockForTrueIs = function($block) { $block->blockArgumentsAre();  }
			)
			->then
				->object($this->testedInstance->blockForOIntegerComparisonBetweenOIntegersIs($firstOperand, $secondOperand, $block))
					->isEqualTo($this->newTestedInstance($oboolean))
				->mock($block)
					->receive('blockArgumentsAre')
						->once
		;
	}
}
