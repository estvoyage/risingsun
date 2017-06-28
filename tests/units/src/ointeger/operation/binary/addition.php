<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;

class addition extends units\ointeger\operation\binary
{
	use units\providers\ninteger\operation\addition { units\providers\ninteger\operation\addition::operandsProvider as nintegersProvider; }
}
