<?php namespace estvoyage\risingsun\http;

use
	estvoyage\risingsun
;

class method extends risingsun\ostring\notEmpty
{
	function __construct(risingsun\ostring\notEmpty $value)
	{
		parent::__construct($value);
	}

	function ifIsEqualToHttpMethod(self $method, risingsun\block $block)
	{
		$method->ifEqualToString($this, $block);

		return $this;
	}
}
