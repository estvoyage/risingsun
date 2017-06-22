<?php namespace estvoyage\risingsun\comparison\unary\container;

use estvoyage\risingsun\comparison;

class collection
	implements
		comparison\unary\container
{
	private
		$comparisons
	;

	function __construct(comparison\unary... $comparisons)
	{
		$this->comparisons = $comparisons;
	}

	function payloadForUnaryComparisonContainerIteratorIs(iterator $iterator, payload $payload) :void
	{
		$iterator->unaryComparisonsForPayloadAre($payload, ... $this->comparisons);
	}
}
