<?php namespace estvoyage\risingsun\block\collection;

use
	estvoyage\risingsun
;

interface iterator
{
	function blocksForPayloadAre(payload $payload, risingsun\block... $blocks);
}
