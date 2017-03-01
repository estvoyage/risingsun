<?php namespace estvoyage\risingsun\comparison\container;

use estvoyage\risingsun\{ comparison\container, comparison, container\iterator };

class collection
	implements
		container
{
	private
		$comparisons
	;

	function __construct(comparison... $comparisons)
	{
		$this->comparisons = $comparisons;
	}

	function controllerOfPayloadForComparisonContainerIteratorIs(container\payload $payload, container\iterator $iterator, iterator\controller $controller)
	{
		$iterator->comparisonsForPayloadWithControllerAre($payload, $controller, ...$this->comparisons);

		return $this;
	}
}
