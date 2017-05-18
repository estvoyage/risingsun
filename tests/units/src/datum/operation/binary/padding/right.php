<?php namespace estvoyage\risingsun\tests\units\datum\operation\binary\padding;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block };
use mock\estvoyage\risingsun\{ datum as mockOfDatum, ointeger as mockOfOInteger };

class right extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\binary')
		;
	}

	function testRecipientOfDatumOperationOnDataIs()
	{
		$this
			->given(
				$firstOperand = new mockOfDatum,
				$secondOperand = new mockOfDatum,
				$recipient = new mockOfDatum\recipient,
				$length = new mockOfOInteger\unsigned
			)
			->if(
				$this->newTestedInstance($length)
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($length))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$firstOperandValue = '',
				$secondOperandValue = '',
				$lengthValue = 1,
				$padded = new mockOfDatum
			)
			->if(
				$this->calling($firstOperand)->recipientOfNStringIs = function($recipient) use (& $firstOperandValue) {
					$recipient->nstringIs($firstOperandValue);
				},
				$this->calling($secondOperand)->recipientOfNStringIs = function($recipient) use (& $secondOperandValue) {
					$recipient->nstringIs($secondOperandValue);
				},
				$this->calling($length)->recipientOfNIntegerIs = function($recipient) use (& $lengthValue) {
					$recipient->nintegerIs($lengthValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($length))
				->mock($recipient)
					->receive('datumIs')
						->never

			->if(
				$secondOperandValue = 'a',

				$this->calling($firstOperand)->recipientOfDatumWithNStringIs = function($value, $recipient) use ($padded, $secondOperandValue) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$value,
							$secondOperandValue,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $padded)
								{
									$recipient->datumIs($padded);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($length))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($padded)
							->once

			->if(
				$secondOperandValue = 'aaaa',
				$lengthValue = 8,

				$this->calling($firstOperand)->recipientOfDatumWithNStringIs = function($value, $recipient) use ($padded, $secondOperandValue) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$value,
							'aaaaaaaa',
							new comparison\recipient\functor\ok(
								function() use ($recipient, $padded)
								{
									$recipient->datumIs($padded);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($length))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($padded)
							->twice

			->if(
				$secondOperandValue = 'aaaaaaaa',

				$this->calling($firstOperand)->recipientOfDatumWithNStringIs = function($value, $recipient) use ($padded, $secondOperandValue) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$value,
							$secondOperandValue,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $padded)
								{
									$recipient->datumIs($padded);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($length))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($padded)
							->thrice

			->if(
				$secondOperandValue = '0',

				$this->calling($firstOperand)->recipientOfDatumWithNStringIs = function($value, $recipient) use ($padded, $secondOperandValue) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$value,
							'00000000',
							new comparison\recipient\functor\ok(
								function() use ($recipient, $padded)
								{
									$recipient->datumIs($padded);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationOnDataIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($length))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($padded)
							->{4}
		;
	}
}
