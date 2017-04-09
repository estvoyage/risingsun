<?php namespace estvoyage\risingsun\tests\units\time\duration\seconde;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, time, comparison, block };
use mock\estvoyage\risingsun\time as mockOfTime;

class any extends units\test
{
	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(0));
	}
}
