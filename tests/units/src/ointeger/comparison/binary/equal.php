<?php namespace estvoyage\risingsun\tests\units\ointeger\comparison\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, comparison as mockOfComparison };

class equal extends units\ointeger\comparison\binary
{
	use units\providers\ointeger\comparison\equal;
}
