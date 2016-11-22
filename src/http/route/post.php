<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun\hash,
	estvoyage\risingsun\http,
	estvoyage\risingsun\block
;

class post extends method
	implements
		http\route
{
	function __construct(http\route $route)
	{
		parent::__construct(new http\method\post, $route);
	}
}
