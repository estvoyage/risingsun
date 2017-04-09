<?php namespace estvoyage\risingsun\tests\functionals;

use estvoyage\risingsun\{ ointeger, block, ostring };

require __DIR__ . '/../../vendor/autoload.php';

(
	new ointeger\comparison\binary\greaterThanOrEqualTo
	(
		new block\output\line(new ostring\any('0 is greater than or equal to 0')),
		new block\output\line(new ostring\any('Not greater than or equal to 0'))
	)
)
	->referenceForComparisonWithOIntegerIs(
		new ointeger\any,
		new ointeger\any
	)
	->referenceForComparisonWithOIntegerIs(
		new ointeger\any,
		new ointeger\any(rand(1, PHP_INT_MAX))
	)
;
