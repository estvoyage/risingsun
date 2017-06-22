<?php namespace estvoyage\risingsun\datum\operation\unary\container\iterator;

use estvoyage\risingsun\{ datum, container };

class any
	implements
		datum\operation\unary\container\iterator
{
	private
		$engine
	;

	function __construct(container\iterator\engine $engine)
	{
		$this->engine = $engine;
	}

	function unaryDatumOperationsForPayloadAre(datum\operation\unary\container\payload $payload, datum\operation\unary... $operations) :void
	{
		$this->engine
			->valuesForContainerIteratorPayloadIs(
				new container\iterator\payload\functor(
					function($operation, $position, $controller) use ($payload)
					{
						$payload->containerIteratorEngineControllerForUnaryDatumOperationAtPositionIs($operation, $position, $controller);
					}
				),
				... $operations
			)
		;
	}
}
