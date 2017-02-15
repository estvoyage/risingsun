<?php namespace estvoyage\risingsun\tests\units\dictionary;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\dictionary as mockOfDictionary;

class rewritable extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\dictionary')
		;
	}

	function testRecipientOfDictionaryWithPairIs()
	{
		$this
			->given(
				$pair = new mockOfDictionary\pair,
				$recipient = new mockOfDictionary\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfDictionaryWithPairIs($pair, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('dictionaryIs')
						->never

			->if(
				$this->calling($pair)->recipientOfDictionaryKeyIs = function($recipient) {
					$recipient->nstringIs('foo');
				}
			)
			->then
				->object($this->testedInstance->recipientOfDictionaryWithPairIs($pair, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('dictionaryIs')
						->withArguments($this->newTestedInstance($pair))
							->once

			->given(
				$otherPair = new mockOfDictionary\pair
			)
			->if(
				$this->calling($otherPair)->recipientOfDictionaryKeyIs = function($recipient) {
					$recipient->nstringIs('foo');
				},
				$otherPair->id = uniqid(),

				$this->newTestedInstance($pair)
			)
			->then
				->object($this->testedInstance->recipientOfDictionaryWithPairIs($otherPair, $recipient))
					->isEqualTo($this->newTestedInstance($pair))
				->mock($recipient)
					->receive('dictionaryIs')
						->withArguments($this->newTestedInstance($otherPair))
							->once

			->if(
				$childOfTestedClass = new childOfTestedClass
			)
			->then
				->object($childOfTestedClass->recipientOfDictionaryWithPairIs($pair, $recipient))
					->isEqualTo($childOfTestedClass)
				->mock($recipient)
					->receive('dictionaryIs')
						->withArguments(new childOfTestedClass($pair))
							->once
		;
	}
}
