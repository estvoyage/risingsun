<?php namespace estvoyage\risingsun\tests\units;

require __DIR__ . '/../runner.php';

use
	estvoyage\risingsun\tests\units
;

class blackhole extends units\test
{
	function test()
	{
		$this->object($this->newTestedInstance->{uniqid()}(...range(1, 10)))->isTestedInstance;
	}
}
