<?php namespace estvoyage\risingsun\block\iterator;

use
	estvoyage\risingsun,
	estvoyage\risingsun\block
;

class fifo extends block\iterator
{
	function __construct(block\collection $collection)
	{
		parent::__construct(new block\collection\iterator\fifo, $collection);
	}

}
