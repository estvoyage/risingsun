<?php namespace estvoyage\risingsun\tests\functionals;

use estvoyage\risingsun\{ container\collection, container\iterator\fifo, container\iterator\controller\stopper, block\functor, ointeger, oboolean };

require __DIR__ . '/../../vendor/autoload.php';

(
	new collection(
		new ointeger\any,
		new ointeger\any(1),
		new ointeger\any(2),
		new ointeger\any(3),
		new ointeger\any(4),
		new ointeger\any(5),
		new ointeger\any(6)
	)
)
	->payloadForContainerIteratorIs(
		new fifo(new stopper, new ointeger\generator\operation\binary\addition(new ointeger\any(42), new ointeger\any(42))),
		new functor(
			function($value, $position, $controller)
			{
				var_dump($value, $position);
			}
		)
	)
	->payloadForContainerIteratorIs(
		new fifo,
		new functor(
			function($value, $position, $controller)
			{
				var_dump($value, $position);

				$value->recipientOfComparisonWithOIntegerIs(
					new ointeger\comparison\equal,
					new ointeger\any(3),
					new functor(
						function($oboolean)  use ($controller)
						{
							$oboolean->blockForTrueIs(
								new functor(
									function() use ($controller)
									{
										$controller->nextContainerValuesAreUseless();
									}
								)
							);
						}
					)
				);
			}
		)
	)
;
