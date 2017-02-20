<?php namespace estvoyage\risingsun\container\iterator;

use estvoyage\risingsun\{ datum };

class lifo extends fifo
{
	function dataForPayloadAre(datum\container\payload $payload, datum... $data)
	{
		return parent::dataForPayloadAre($payload, ... array_reverse($data));
	}
}
