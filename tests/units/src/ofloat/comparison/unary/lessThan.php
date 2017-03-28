<?php namespace estvoyage\risingsun\tests\units\ofloat\comparison\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ofloat, oboolean };
use mock\estvoyage\risingsun\{ ofloat as mockOfOFloat, oboolean as mockOfOBoolean };

class lessThan extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ofloat\comparison\unary')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new ofloat\any, new oboolean\ok, new oboolean\ko));
	}

	function testRecipientOfOFloatComparisonWithFloatIs()
	{
		$this
			->given(
				$reference = new mockOfOFloat,
				$ok = new mockOfOBoolean,
				$ko = new mockOfOBoolean,
				$ofloat = new mockOfOFloat,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance($reference, $ok, $ko)
			)
			->then
				->object($this->testedInstance->recipientOfOFloatComparisonWithOFloatIs($ofloat, $recipient))
					->isEqualTo($this->newTestedInstance($reference, $ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->given(
				$this->calling($reference)->recipientOfNFloatIs = function($recipient) use (& $referenceValue) {
					$recipient->nfloatIs($referenceValue);
				}
			)
			->if(
				$referenceValue = 1.2
			)
			->then
				->object($this->testedInstance->recipientOfOFloatComparisonWithOFloatIs($ofloat, $recipient))
					->isEqualTo($this->newTestedInstance($reference, $ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->given(
				$this->calling($ofloat)->recipientOfNFloatIs = function($recipient) use (& $ofloatValue) {
					$recipient->nfloatIs($ofloatValue);
				}
			)
			->if(
				$ofloatValue = 2.3
			)
			->then
				->object($this->testedInstance->recipientOfOFloatComparisonWithOFloatIs($ofloat, $recipient))
					->isEqualTo($this->newTestedInstance($reference, $ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($ko)
							->once

			->if(
				$ofloatValue = $referenceValue
			)
			->then
				->object($this->testedInstance->recipientOfOFloatComparisonWithOFloatIs($ofloat, $recipient))
					->isEqualTo($this->newTestedInstance($reference, $ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($ko)
							->twice

			->if(
				$ofloatValue = - $referenceValue
			)
			->then
				->object($this->testedInstance->recipientOfOFloatComparisonWithOFloatIs($ofloat, $recipient))
					->isEqualTo($this->newTestedInstance($reference, $ok, $ko))
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($ok)
							->once
		;
	}
}
