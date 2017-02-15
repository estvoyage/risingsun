<?php namespace estvoyage\risingsun\container;

class collection
{
	private
		$values
	;

	function __construct(... $values)
	{
		$this->values = $values;
	}

	function payloadForContainerIteratorIs(iterator $iterator, payload $payload)
	{
		$iterator->payloadForContainerValuesIs($this->values, $payload);

		return $this;
	}
}
