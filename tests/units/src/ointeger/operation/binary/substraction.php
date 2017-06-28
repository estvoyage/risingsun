<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, block, ointeger };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, block as mockOfBlock };

class substraction extends units\ointeger\operation\binary
{
	use units\providers\ninteger\operation\substraction { units\providers\ninteger\operation\substraction::operandsProvider as nintegersProvider; }
}
