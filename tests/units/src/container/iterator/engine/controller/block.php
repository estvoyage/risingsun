<?php namespace estvoyage\risingsun\tests\units\container\iterator\engine\controller;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\{ risingsun\tests\units, risingsun };
use mock\estvoyage\risingsun\{ container\iterator\engine as mockOfEngine, block as mockOfBlock };

class block extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\container\iterator\engine\controller')
		;
	}

	function testConstructor()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new risingsun\block\blackhole));
	}

	function testRecipientOfContainerIteratorEngineControllerWithBlockIs()
	{
		$this
			->given(
				$block = new mockOfBlock,
				$otherBlock = new mockOfBlock,
				$recipient = new mockOfEngine\controller\recipient
			)
			->if(
				$this->newTestedInstance($block)
			)
			->then
				->object($this->testedInstance->recipientOfContainerIteratorEngineControllerWithBlockIs($otherBlock, $recipient))
					->isEqualTo($this->newTestedInstance($block))
				->mock($recipient)
					->receive('containerIteratorEngineControllerIs')
						->withArguments($this->newTestedInstance($otherBlock))
							->once
			->if(
				$testedInstance = new childOfTestedClass($block)
			)
			->then
				->object($testedInstance->recipientOfContainerIteratorEngineControllerWithBlockIs($otherBlock, $recipient))
					->isEqualTo(new childOfTestedClass($block))
				->mock($recipient)
					->receive('containerIteratorEngineControllerIs')
						->withArguments(new childOfTestedClass($otherBlock))
							->once
		;
	}

	function testRemainingIterationsInContainerIteratorEngineAreUseless()
	{
		$this
			->given(
				$block = new mockOfBlock
			)
			->if(
				$this->newTestedInstance($block)
			)
			->then
				->object($this->testedInstance->remainingIterationsInContainerIteratorEngineAreUseless())
					->isEqualTo($this->newTestedInstance($block))
				->mock($block)
					->receive('blockArgumentsAre')
						->once
		;
	}
}
