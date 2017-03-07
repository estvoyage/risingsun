<?php namespace estvoyage\risingsun\container\iterator\engine;

use estvoyage\risingsun\container\iterator\payload;

class lifo extends fifo
{
	function valuesForContainerIteratorPayloadIs(payload $payload, ... $values)
	{
		return parent::valuesForContainerIteratorPayloadIs($payload, ... array_reverse($values));
	}

}
