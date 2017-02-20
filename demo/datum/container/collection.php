<?php namespace estvoyage\risingsun\tests\functionals;

use estvoyage\risingsun\{ container\iterator\fifo, container\iterator\controller\stopper, block\functor, ointeger, datum, ostring, output, datum\container\payload };

require __DIR__ . '/../../../vendor/autoload.php';

(
	new datum\container\collection(
		new ointeger\any,
		new ointeger\any(1),
		new ointeger\any(2),
		new ointeger\any(3),
		new ointeger\any(4),
		new ointeger\any(5),
		new ointeger\any(6)
	)
)
	->payloadForDatumContainerIteratorIs(
		new fifo,
		new payload\output\line(
			new output\stdout,
			new datum\operation\binary\pair(
				new ostring\any('('),
				new ostring\any(':'),
				new ostring\any(')')
			)
		)
	)
	->payloadForDatumContainerIteratorIs(
		new fifo(new stopper, new ointeger\generator\operation\binary\addition(new ointeger\any(42), new ointeger\any(42))),
		new payload\output\line(
			new output\stdout,
			new datum\operation\binary\pair(
				new ostring\any('('),
				new ostring\any(':'),
				new ostring\any(')')
			)
		)
	)
	->payloadForDatumContainerIteratorIs(
		new fifo,
		new functor(
			function($value, $position, $controller)
			{
				(new output\stdout)
					->outputLineIsOperationOnData(
						new datum\operation\binary\pair(
							new ostring\any('('),
							new ostring\any(':'),
							new ostring\any(')')
						),
						$position,
						$value
					)
				;

				$value->blockForComparisonWithOIntegerIs(
					new ointeger\comparison\equal,
					new ointeger\any(3),
					new functor(
						function() use ($controller)
						{
							$controller->nextContainerValuesAreUseless();
						}
					)
				);
			}
		)
	)
;
