<?php namespace estvoyage\risingsun\tests\units\comparison\unary;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\comparison as mockOfComparison;

class equal extends units\comparison\unary
{
	use units\providers\comparison\equal;
}
