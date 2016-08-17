<?php namespace estvoyage\risingsun\tests\units\ofloat\part\decimal;

require __DIR__ . '/../../../../runner.php';

use
	estvoyage\risingsun\tests\units
;

class precision extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\ointeger\unsigned')
		;
	}

	function testWithZero()
	{
		$this->exception(function() {
				$this->newTestedInstance(0);
			}
		)
			->isInstanceOf('DomainException')
			->hasMessage('Decimal part precision must be greater than 0')
		;
	}
}
