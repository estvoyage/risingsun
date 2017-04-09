<?php namespace estvoyage\risingsun\tests\units\time\duration\seconde\micro\operation\unary\substraction;

require __DIR__ . '/../../../../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ointeger, comparison, block };
use mock\estvoyage\risingsun\time as mockOfTime;

class seconde extends units\test
{
	function testMicroSecondRecipientForOperationWithMicroSecondeIs()
	{
		$this
			->given(
				$seconde = new mockOfTime\duration\seconde,
				$recipient = new mockOfTime\duration\seconde\micro\recipient,
				$micro = new mockOfTime\duration\seconde\micro
			)
			->if(
				$this->newTestedInstance($seconde)
			)
			->then
				->object($this->testedInstance->microSecondeRecipientForOperationWithMicroSecondeIs($micro, $recipient))
					->isEqualTo($this->newTestedInstance($seconde))
				->mock($recipient)
					->receive('microSecondeIs')
						->never

			->if(
				$this->calling($micro)->recipientOfOIntegerIs = function($recipient) {
					$recipient->ointegerIs(new ointeger\any);
				},

				$microFromOperation = new mockOfTime\duration\seconde\micro,

				$this->calling($micro)->recipientOfMicroSecondeWithOIntegerIs = function($ointeger, $recipient) use ($microFromOperation) {
					(
						new ointeger\comparison\binary\equal(
							new block\functor(
								function() use ($microFromOperation, $recipient)
								{
									$recipient->microSecondeIs($microFromOperation);
								}
							)
						)
					)
						->referenceForComparisonWithOIntegerIs($ointeger, new ointeger\any)
					;
				},

				$this->calling($seconde)->recipientOfOIntegerIs = function($recipient) {
					$recipient->ointegerIs(new ointeger\any);
				}
			)
			->then
				->object($this->testedInstance->microSecondeRecipientForOperationWithMicroSecondeIs($micro, $recipient))
					->isEqualTo($this->newTestedInstance($seconde))
				->mock($recipient)
					->receive('microSecondeIs')
						->withArguments($microFromOperation)
							->once

			->if(
				$this->calling($micro)->recipientOfOIntegerIs = function($recipient) {
					$recipient->ointegerIs(new ointeger\any(1000000));
				},

				$microFromOperation = new mockOfTime\duration\seconde\micro,

				$this->calling($micro)->recipientOfMicroSecondeWithOIntegerIs = function($ointeger, $recipient) use ($microFromOperation) {
					(
						new ointeger\comparison\binary\equal(
							new block\functor(
								function() use ($microFromOperation, $recipient)
								{
									$recipient->microSecondeIs($microFromOperation);
								}
							)
						)
					)
						->referenceForComparisonWithOIntegerIs($ointeger, new ointeger\any(-1000000))
					;
				},

				$this->calling($seconde)->recipientOfOIntegerIs = function($recipient) {
					$recipient->ointegerIs(new ointeger\any);
				}
			)
			->then
				->object($this->testedInstance->microSecondeRecipientForOperationWithMicroSecondeIs($micro, $recipient))
					->isEqualTo($this->newTestedInstance($seconde))
				->mock($recipient)
					->receive('microSecondeIs')
						->withArguments($microFromOperation)
							->once

			->if(
				$this->calling($micro)->recipientOfOIntegerIs = function($recipient) {
					$recipient->ointegerIs(new ointeger\any(1000000));
				},

				$microFromOperation = new mockOfTime\duration\seconde\micro,

				$this->calling($micro)->recipientOfMicroSecondeWithOIntegerIs = function($ointeger, $recipient) use ($microFromOperation) {
					(
						new ointeger\comparison\binary\equal(
							new block\functor(
								function() use ($microFromOperation, $recipient)
								{
									$recipient->microSecondeIs($microFromOperation);
								}
							)
						)
					)
						->referenceForComparisonWithOIntegerIs($ointeger, new ointeger\any)
					;
				},

				$this->calling($seconde)->recipientOfOIntegerIs = function($recipient) {
					$recipient->ointegerIs(new ointeger\any(1));
				}
			)
			->then
				->object($this->testedInstance->microSecondeRecipientForOperationWithMicroSecondeIs($micro, $recipient))
					->isEqualTo($this->newTestedInstance($seconde))
				->mock($recipient)
					->receive('microSecondeIs')
						->withArguments($microFromOperation)
							->once

			->if(
				$this->calling($micro)->recipientOfOIntegerIs = function($recipient) {
					$recipient->ointegerIs(new ointeger\any(1600000));
				},

				$microFromOperation = new mockOfTime\duration\seconde\micro,

				$this->calling($micro)->recipientOfMicroSecondeWithOIntegerIs = function($ointeger, $recipient) use ($microFromOperation) {
					(
						new ointeger\comparison\binary\equal(
							new block\functor(
								function() use ($microFromOperation, $recipient)
								{
									$recipient->microSecondeIs($microFromOperation);
								}
							)
						)
					)
						->referenceForComparisonWithOIntegerIs($ointeger, new ointeger\any(400000))
					;
				},

				$this->calling($seconde)->recipientOfOIntegerIs = function($recipient) {
					$recipient->ointegerIs(new ointeger\any(2));
				}
			)
			->then
				->object($this->testedInstance->microSecondeRecipientForOperationWithMicroSecondeIs($micro, $recipient))
					->isEqualTo($this->newTestedInstance($seconde))
				->mock($recipient)
					->receive('microSecondeIs')
						->withArguments($microFromOperation)
							->once
		;
	}
}
