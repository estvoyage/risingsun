<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun\{hash, http, block}
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
