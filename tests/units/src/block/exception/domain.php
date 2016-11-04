<?php namespace estvoyage\risingsun\tests\units\block\exception;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun
;

class domain extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\block')
		;
	}

	function testBlockArgumentsAre()
	{
		$this
			->given(
				$message = new risingsun\ostring\notEmpty(uniqid())
			)
			->if(
				$this->newTestedInstance($message)
			)
			->then
				->exception(function() {
							$this->testedInstance->blockArgumentsAre();
						}
					)
					->isInstanceOf('domainException')
					->message
						->isEqualTo($message)
		;
	}
}
