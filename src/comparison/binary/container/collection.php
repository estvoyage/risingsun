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

	function controllerOfPayloadForBinaryComparisonContainerIteratorIs(comparison\container\payload $payload, comparison\container\iterator $iterator, iterator\controller $controller)
	{
		$iterator->binaryComparisonsForPayloadWithControllerAre($payload, $controller, ...$this->comparisons);

		return $this;
	}
}
