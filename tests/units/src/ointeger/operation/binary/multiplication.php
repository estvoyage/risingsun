<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;

class multiplication extends units\ointeger\operation\binary
{
	use units\providers\ninteger\operation\multiplication { units\providers\ninteger\operation\multiplication::operandsProvider as nintegersProvider; }
}
