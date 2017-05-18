<?php namespace estvoyage\risingsun\tests\units\ofloat\comparison;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ ofloat as mockOfOFloat, comparison as mockOfComparison };

abstract class unary extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ofloat\comparison\unary')
		;
	}

	/**
	 * @dataProvider provider
	 */
	function testRecipientOfComparisonWithOFloatIs($operand, $reference, $boolean)
	{
		$this
			->given(
				$oFloat = new mockOfOFloat,
				$this->calling($oFloat)->recipientOfNFloatIs = function($recipient) use ($operand) {
					$recipient->nfloatIs($operand);
				},

				$oReference = new mockOfOFloat,
				$this->calling($oReference)->recipientOfNFloatIs = function($recipient) use ($reference) {
					$recipient->nfloatIs($reference);
				},

				$recipient = new mockOfComparison\recipient,

				$this->newTestedInstance($oReference)
			)
			->if(
				$this->testedInstance->recipientOfComparisonWithOFloatIs($oFloat, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($oReference))
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments($boolean)
							->once
		;
	}

	protected abstract function provider();
}
