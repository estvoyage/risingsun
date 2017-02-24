<?php namespace estvoyage\risingsun\tests\units\comparison;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\{ oboolean as mockOfOBoolean, comparison as mockOfComparison };

class pipe extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison')
		;
	}

	function testRecipientOfComparisonIs()
	{
		$this
			->given(
				$comparison1 = new mockOfComparison,
				$comparison2 = new mockOfComparison,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance($comparison1, $comparison2)
			)
			->then
				->object($this->testedInstance->recipientOfComparisonIs($recipient))
					->isEqualTo($this->newTestedInstance($comparison1, $comparison2))
				->mock($recipient)
					->receive('obooleanIs')
						->witharguments(new oboolean\ko)
							->once

			->given(
				$this->calling($comparison1)->recipientOfComparisonIs = function($recipient) use (& $oboolean1) {
					$recipient->obooleanIs($oboolean1);
				}
			)

			->if(
				$oboolean1 = new oboolean\ko
			)
			->then
				->object($this->testedInstance->recipientOfComparisonIs($recipient))
					->isEqualTo($this->newTestedInstance($comparison1, $comparison2))
				->mock($recipient)
					->receive('obooleanIs')
						->witharguments(new oboolean\ko)
							->twice

			->if(
				$oboolean1 = new oboolean\ok
			)
			->then
				->object($this->testedInstance->recipientOfComparisonIs($recipient))
					->isEqualTo($this->newTestedInstance($comparison1, $comparison2))
				->mock($recipient)
					->receive('obooleanIs')
						->witharguments(new oboolean\ok)
							->once

			->given(
				$this->calling($comparison2)->recipientOfComparisonIs = function($recipient) use (& $oboolean2) {
					$recipient->obooleanIs($oboolean2);
				}
			)

			->if(
				$oboolean1 = new oboolean\ko,
				$oboolean2 = new oboolean\ko
			)
			->then
				->object($this->testedInstance->recipientOfComparisonIs($recipient))
					->isEqualTo($this->newTestedInstance($comparison1, $comparison2))
				->mock($recipient)
					->receive('obooleanIs')
						->witharguments(new oboolean\ko)
							->thrice

			->if(
				$oboolean1 = new oboolean\ko,
				$oboolean2 = new oboolean\ok
			)
			->then
				->object($this->testedInstance->recipientOfComparisonIs($recipient))
					->isEqualTo($this->newTestedInstance($comparison1, $comparison2))
				->mock($recipient)
					->receive('obooleanIs')
						->witharguments(new oboolean\ko)
							->{4}

			->if(
				$oboolean1 = new oboolean\ok,
				$oboolean2 = new oboolean\ko
			)
			->then
				->object($this->testedInstance->recipientOfComparisonIs($recipient))
					->isEqualTo($this->newTestedInstance($comparison1, $comparison2))
				->mock($recipient)
					->receive('obooleanIs')
						->witharguments(new oboolean\ko)
							->{5}

			->if(
				$oboolean1 = new oboolean\ok,
				$oboolean2 = new oboolean\ok
			)
			->then
				->object($this->testedInstance->recipientOfComparisonIs($recipient))
					->isEqualTo($this->newTestedInstance($comparison1, $comparison2))
				->mock($recipient)
					->receive('obooleanIs')
						->witharguments(new oboolean\ok)
							->twice
		;
	}
}
