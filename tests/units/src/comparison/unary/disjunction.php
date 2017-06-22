<?php namespace estvoyage\risingsun\tests\units\comparison\unary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ comparison as mockOfComparison, oboolean as mockOfOBoolean };

class disjunction extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\unary')
		;
	}

	function testRecipientOfComparisonWithOperandIs()
	{
		$this
			->given(
				$container = new mockOfComparison\unary\container,
				$oboolean = new mockOfOBoolean,
				$value = uniqid(),
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->newTestedInstance($container, $oboolean)->recipientOfComparisonWithOperandIs($value, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($container, $oboolean))
				->mock($recipient)
					->receive('nbooleanIs')
						->never

			->given(
				$comparison1 = new mockOfComparison\unary,
				$this->calling($comparison1)->recipientOfComparisonWithOperandIs = function($operand, $recipient) {
					$recipient->nbooleanIs(true);
				},

				$comparison2 = new mockOfComparison\unary,
				$this->calling($comparison2)->recipientOfComparisonWithOperandIs = function($operand, $recipient) {
					$recipient->nbooleanIs(false);
				},

				$this->calling($container)->payloadForUnaryComparisonContainerIteratorIs = function($iterator, $payload) use ($comparison1, $comparison2) {
					$iterator->unaryComparisonsForPayloadAre($payload, $comparison1, $comparison2);
				},

				$obooleanWithNBoolean = new mockOfOBoolean,

				$this->calling($oboolean)->recipientOfOBooleanWithNBooleanIs = function($nboolean, $recipient) use ($obooleanWithNBoolean) {
					$recipient->obooleanIs($obooleanWithNBoolean);
				},

				$this->calling($obooleanWithNBoolean)->recipientOfNBooleanIs = function($recipient) {
					$recipient->nbooleanIs(true);
				}
			)
			->if(
				$this->newTestedInstance($container, $oboolean)->recipientOfComparisonWithOperandIs($value, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($container, $oboolean))
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(true)
							->once
				->mock($comparison2)
					->receive('recipientOfComparisonWithOperandIs')
						->never
		;
	}
}
