<?php namespace estvoyage\risingsun\tests\units\time\duration\seconde;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, time, comparison, block };
use mock\estvoyage\risingsun\time as mockOfTime;

class any extends units\time\duration\any
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\time\duration\seconde')
		;
	}
}
