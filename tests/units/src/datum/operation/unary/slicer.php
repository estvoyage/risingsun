<?php namespace estvoyage\risingsun\tests\units\datum\operation\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, datum as mockOfDatum };

class slicer extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\unary')
		;
	}

	function testRecipientOfOperationWithDatumIs()
	{
		$this
			->given(
				$position = new mockOfOInteger\unsigned,
				$length = new mockOfOInteger\unsigned,
				$datum = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->newTestedInstance($position, $length)
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($position, $length))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$positionValue = 0,
				$lengthValue = 4,
				$datumValue = 'abcd',
				$slice = new mockOfDatum
			)
			->if(
				$this->calling($position)->recipientOfNIntegerIs = function($recipient) use (& $positionValue) {
					$recipient->nintegerIs($positionValue);
				},
				$this->calling($length)->recipientOfNIntegerIs = function($recipient) use ($lengthValue) {
					$recipient->nintegerIs($lengthValue);
				},
				$this->calling($datum)->recipientOfNStringIs = function($recipient) use ($datumValue) {
					$recipient->nstringIs($datumValue);
				},
				$this->calling($datum)->recipientOfDatumWithNStringIs = function($value, $recipient) use ($datumValue, $slice) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$value,
							$datumValue,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $slice)
								{
									$recipient->datumIs($slice);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($position, $length))
				->mock($recipient)
					->receive('datumIs')
						->withIdenticalArguments($slice)
							->once

			->if(
				$positionValue = 2,
				$this->calling($datum)->recipientOfDatumWithNStringIs = function($value, $recipient) use ($datumValue, $slice) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$value,
							'cd',
							new comparison\recipient\functor\ok(
								function() use ($recipient, $slice)
								{
									$recipient->datumIs($slice);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($position, $length))
				->mock($recipient)
					->receive('datumIs')
						->withIdenticalArguments($slice)
							->twice

			->if(
				$positionValue = 4,
				$this->calling($datum)->recipientOfDatumWithNStringIs = function($value, $recipient) use ($datumValue, $slice) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$value,
							'',
							new comparison\recipient\functor\ok(
								function() use ($recipient, $slice)
								{
									$recipient->datumIs($slice);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($position, $length))
				->mock($recipient)
					->receive('datumIs')
						->withIdenticalArguments($slice)
							->thrice
		;
	}
}
