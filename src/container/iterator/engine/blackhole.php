<?php namespace estvoyage\risingsun\container\iterator\engine;

use estvoyage\risingsun\container\iterator;

class blackhole
	implements
		iterator\engine
{
	function valuesForContainerIteratorPayloadIs(iterator\payload $payload, ... $values)
	{
		return $this;
	}
}
