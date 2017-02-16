<?php namespace estvoyage\risingsun\tests\functionals;

use estvoyage\risingsun\{ container\collection, container\iterator\fifo, container\iterator\controller\stopper, block\functor };

require __DIR__ . '/../../vendor/autoload.php';

(new collection(...range(1, 10)))
	->payloadForContainerIteratorIs(
		new fifo(new stopper),
		new functor(
			function($value, $position, $controller)
			{
				var_dump($value);
			}
		)
	)
;

(new collection(...range(1, 6)))
	->payloadForContainerIteratorIs(
		new fifo(new stopper),
		new functor(
			function($value, $position, $controller)
			{
				var_dump($value);

				if ($value == 3)
				{
					$controller->nextContainerValuesAreUseless();
				}
			}
		)
	)
;