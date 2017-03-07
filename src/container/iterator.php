<?php namespace estvoyage\risingsun\container;

use estvoyage\risingsun\{ container\iterator, block\functor, ointeger\generator, datum, comparison, block };

class iterator
	implements
		datum\container\iterator,
		comparison\binary\container\iterator
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
		$this->engine
			->valuesForContainerIteratorPayloadIs(
				new functor(
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
		$this->engine
			->valuesForContainerIteratorPayloadIs(
				new functor(
					function($comparison, $position, $controller) use ($payload)
					{
						$payload->containerIteratorEngineControllerForBinaryComparisonAtPositionIs($comparison, $position, $controller);
					}
				),
				... $comparisons
			)
		;

		return $this;
	}
}
