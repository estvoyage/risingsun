<?php namespace estvoyage\risingsun\tests\units\datum\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, block\functor, ostring };
use mock\estvoyage\risingsun\{ datum as mockOfDatum, nstring as mockOfNString };

class pair extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\binary')
		;
	}

	function testWithoutValues()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new ostring\any('('), new ostring\any(':'), new ostring\any(')')));
	}

	function testRecipientOfOperationOnDataIs()
	{
		$this
			->given(
				$prefix = new mockOfDatum,
				$separator = new mockOfDatum,
				$suffix = new mockOfDatum,
				$firstDatum = new mockOfDatum,
				$secondDatum = new mockOfDatum,
				$recipient = new mockOfNString\recipient
			)
			->if(
				$this->newTestedInstance($prefix, $separator, $suffix)
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnDataIs($firstDatum, $secondDatum, $recipient))
					->isEqualTo($this->newTestedInstance($prefix, $separator, $suffix))
				->mock($recipient)
					->receive('nstringIs')
						->withArguments('')
							->once

			->if(
				$this->calling($prefix)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('(');
				},
				$this->calling($separator)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs(':');
				},
				$this->calling($suffix)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs(')');
				},
				$this->calling($firstDatum)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('foo');
				},
				$this->calling($secondDatum)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('bar');
				},

				$this->newTestedInstance($prefix, $separator, $suffix)
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnDataIs($firstDatum, $secondDatum, $recipient))
					->isEqualTo($this->newTestedInstance($prefix, $separator, $suffix))
				->mock($recipient)
					->receive('nstringIs')
						->withArguments('(foo:bar)')
							->once
		;
	}
}
