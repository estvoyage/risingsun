<?php namespace estvoyage\risingsun\block;

use
	estvoyage\risingsun
;

class collection
{
	private
		$blocks
	;

	function __construct(risingsun\block... $blocks)
	{
		$this->blocks = $blocks;
	}

	function payloadForIteratorIs(risingsun\iterator $iterator, risingsun\iterator\payload $payload)
	{
		$iterator->iteratorPayloadForValuesIs($this->blocks, $payload);

		return $this;
	}
}
