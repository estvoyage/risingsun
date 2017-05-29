<?php namespace estvoyage\risingsun\tests\functionals;

use estvoyage\risingsun\{ ointeger, block, ostring, comparison };

require __DIR__ . '/../../vendor/autoload.php';

(new ointeger\comparison\binary\greaterThanOrEqualTo)
	->recipientOfOIntegerComparisonBetweenOperandAndReferenceIs(
		new ointeger\any,
		new ointeger\any,
		new comparison\recipient\switcher(
			new block\output\line(new ostring\any('0 is greater than or equal to 0')),
			new block\output\line(new ostring\any('Not greater than or equal to 0'))
		)
	)
	->recipientOfOIntegerComparisonBetweenOperandAndReferenceIs(
		new ointeger\any,
		new ointeger\any(rand(1, PHP_INT_MAX)),
		new comparison\recipient\switcher(
			new block\output\line(new ostring\any('0 is greater than or equal to 0')),
			new block\output\line(new ostring\any('Not greater than or equal to 0'))
		)
	)
;
