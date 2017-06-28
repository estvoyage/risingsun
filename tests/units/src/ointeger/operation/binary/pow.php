<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;

class pow extends units\ointeger\operation\binary
{
	use units\providers\ninteger\operation\pow { units\providers\ninteger\operation\pow::operandsProvider as nintegersProvider; }
}
