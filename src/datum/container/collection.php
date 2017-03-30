<?php namespace estvoyage\risingsun\datum\container;

use estvoyage\risingsun\datum;

class collection
	implements
		datum\container
{
	private
		$data
	;

	function __construct(datum... $data)
	{
		$this->data = $data;
	}

	function payloadForDatumContainerIteratorIs(iterator $iterator, payload $payload)
	{
		$iterator->dataForPayloadAre($payload, ...$this->data);

		return $this;
	}
}
