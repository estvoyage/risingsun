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

	function payloadForIteratorIs(collection\iterator $iterator, collection\payload $payload)
	{
		$iterator->blocksForPayloadAre($payload, ... $this->blocks);
		return $this;
	}
}
