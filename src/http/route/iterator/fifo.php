<?php namespace estvoyage\risingsun\http\route\iterator;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http
;

class fifo extends http\route\iterator
{
	function __construct(http\route\collection $collection)
	{
		parent::__construct(new http\route\collection\iterator\fifo, $collection);
	}
}
