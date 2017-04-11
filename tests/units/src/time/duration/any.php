<?php namespace estvoyage\risingsun\tests\units\time\duration;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\time as mockOfTime;

class any extends units\ointeger\any
{
	function testClass()
	{
		parent::testClass();

		$this->testedClass
			->implements('estvoyage\risingsun\time\duration')
		;
	}
}
