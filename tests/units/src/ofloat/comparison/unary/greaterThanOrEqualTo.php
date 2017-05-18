<?php namespace estvoyage\risingsun\tests\units\ofloat\comparison\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ofloat, block };
use mock\estvoyage\risingsun\{ block as mockOfBlock, ofloat as mockOfOFloat };

class greaterThanOrEqualTo extends units\ofloat\comparison\unary
{
	use units\providers\ofloat\comparison\greaterThanOrEqualTo;
}
