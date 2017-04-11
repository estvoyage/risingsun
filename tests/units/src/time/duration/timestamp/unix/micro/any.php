<?php namespace estvoyage\risingsun\tests\units\time\duration\timestamp\unix\micro;

require __DIR__ . '/../../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ostring, datum };
use mock\estvoyage\risingsun\{ nfloat as mockOfNFloat, ointeger as mockOfOInteger, datum as mockOfDatum, nstring as mockOfNString, time\duration\timestamp\unix as mockOfUnix };

class any extends units\ointeger\any
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\time\duration\timestamp\unix\micro')
		;
	}
}
