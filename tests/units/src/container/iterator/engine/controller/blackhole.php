<?php namespace estvoyage\risingsun\tests\units\container\iterator\engine\controller;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ container as mockOfContainer, block as mockOfBlock };

class blackhole extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\container\iterator\engine\controller')
		;
	}

	function testRecipientOfContainerIteratorEngineControllerWithBlockIs()
	{
		$this
			->given(
				$block = new mockOfBlock,
				$recipient = new mockOfContainer\iterator\engine\controller\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfContainerIteratorEngineControllerWithBlockIs($block, $recipient))
					->isEqualTo($this->newTestedInstance)
		;
	}

	function testRemainingIterationsInContainerIteratorEngineAreUseless()
	{
		$this->object($this->newTestedInstance->remainingIterationsInContainerIteratorEngineAreUseless())->isEqualTo($this->newTestedInstance);
	}
}
