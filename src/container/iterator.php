<?php namespace estvoyage\risingsun\container;

use estvoyage\risingsun\{ container\iterator, datum, comparison };

class iterator
	implements
		datum\container\iterator,
		comparison\binary\container\iterator,
		datum\operation\unary\container\iterator,
		iterator\engine
{
	private
		$engine
	;

	function __construct(iterator\engine $engine = null)
	{
		$this->engine = $engine ?: new iterator\engine\fifo;
	}

	function dataForPayloadAre(datum\container\payload $payload, datum... $data)
	{
		return $this
			->valuesForContainerIteratorPayloadIs(
				new iterator\payload\functor(
					function($datum, $position, $controller) use ($payload)
					{
						$payload->containerIteratorEngineControllerForDatumAtPositionIs($datum, $position, $controller);
					}
				),
				... $data
			)
		;

		return $this;
	}

	function binaryComparisonsForPayloadAre(comparison\binary\container\payload $payload, comparison\binary... $comparisons)
	{
		return $this
			->valuesForContainerIteratorPayloadIs(
				new iterator\payload\functor(
					function($comparison, $position, $controller) use ($payload)
					{
						$payload->containerIteratorEngineControllerForBinaryComparisonAtPositionIs($comparison, $position, $controller);
					}
				),
				... $comparisons
			)
		;
	}

	function unaryDatumOperationsForPayloadAre(datum\operation\unary\container\payload $payload, datum\operation\unary... $operations)
	{
		return $this
			->valuesForContainerIteratorPayloadIs(
				new iterator\payload\functor(
					function($operation, $position, $controller) use ($payload)
					{
						$payload->containerIteratorEngineControllerForUnaryDatumOperationAtPositionIs($operation, $position, $controller);
					}
				),
				... $operations
			)
		;
	}

	function valuesForContainerIteratorPayloadIs(iterator\payload $payload, ... $values)
	{
		$this->engine
			->valuesForContainerIteratorPayloadIs(
				$payload,
				... $values
			)
		;

		return $this;
	}
}
