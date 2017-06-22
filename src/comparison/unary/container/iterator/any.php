<?php namespace estvoyage\risingsun\comparison\unary\container\iterator;

use estvoyage\risingsun\{ comparison, container };

class any
	implements
		comparison\unary\container\iterator
{
	private
		$iterator
	;

	function __construct(container\iterator $iterator = null)
	{
		$this->iterator = $iterator ?: new container\iterator;
	}

	function unaryComparisonsForPayloadAre(comparison\unary\container\payload $payload, comparison\unary... $comparisons) :void
	{
		$this->iterator
			->valuesForContainerIteratorPayloadIs(
				new container\iterator\payload\functor(
					function($comparison, $position, $controller) use ($payload)
					{
						$payload->containerIteratorEngineControllerForUnaryComparisonAtPositionIs($comparison, $position, $controller);
					}
				),
				... $comparisons
			)
		;
	}
}
