<?php namespace estvoyage\risingsun\comparison\binary\container;

use estvoyage\risingsun\{ comparison\binary as comparison, container\iterator };

class collection
	implements
		comparison\container
{
	private
		$comparisons
	;

	function __construct(comparison... $comparisons)
	{
		$this->comparisons = $comparisons;
	}

	function payloadForBinaryComparisonContainerIteratorIs(comparison\container\iterator $iterator, comparison\container\payload $payload)
	{
		$iterator->binaryComparisonsForPayloadAre($payload, ... $this->comparisons);

		return $this;
	}
}
