<?php namespace estvoyage\risingsun\http\route\iterator;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http
;

class fifo extends http\route\iterator
{
	function __construct(http\route... $routes)
	{
		parent::__construct(new risingsun\iterator\fifo, ... $routes);
	}
}
