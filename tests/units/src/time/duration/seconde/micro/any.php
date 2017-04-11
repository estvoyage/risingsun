<?php namespace estvoyage\risingsun\tests\units\time\duration\seconde\micro;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ ninteger as mockOfNInteger, time as mockOfTime };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\time\duration\seconde\micro')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(0));
	}

	function testRecipientOfNIntegerIs()
	{
		$this
			->given(
				$recipient = new mockOfNInteger\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfNIntegerIs($recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nintegerIs')
						->withArguments(0)
							->once
		;
	}

	/**
	 * @dataProvider okProvider
	 */
	function testRecipientOfMicroSecondWithNIntegerIs($ninteger)
	{
		$this
			->given(
				$recipient = new mockOfTime\duration\seconde\micro\recipient
			)
			->if(
				$this->newTestedInstance(0)
			)
			->then
				->object($this->testedInstance->recipientOfMicroSecondeWithNIntegerIs($ninteger, $recipient))
					->isEqualTo($this->newTestedInstance(0))
				->mock($recipient)
					->receive('microSecondeIs')
						->withArguments($this->newTestedInstance($ninteger))
							->once
		;
	}

	protected function okProvider()
	{
		return [
			rand(PHP_INT_MIN, -1),
			0,
			rand(1, PHP_INT_MAX)
		];
	}
}
