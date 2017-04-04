<?php namespace estvoyage\risingsun\tests\functionals;

use estvoyage\risingsun\
	{
		ointeger,
		block\functor,
		output,
		ostring,
		oboolean
	}
;

require __DIR__ . '/../../vendor/autoload.php';

(
	new ointeger\comparison\binary\greaterThanOrEqualTo
	(
		new functor(
			function()
			{
				(new output\stdout)
					->outputLineIs(
						new ostring\any('0 is greater than or equal to 0')
					)
				;
			}
		)
	)
)
	->referenceForComparisonWithOIntegerIs(
		new ointeger\any,
		new ointeger\any
	)
;
