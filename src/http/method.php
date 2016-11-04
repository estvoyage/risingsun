<?php namespace estvoyage\risingsun\http;

use
	estvoyage\risingsun
;

class method
{
	private
		$value
	;

	function __construct(risingsun\ostring\notEmpty $value)
	{
		$this->value = $value;
	}

	function ifIsEqualToHttpMethod(self $method, risingsun\block $block)
	{
		$this->value->ifIsEqualToString($method->value, $block);

		return $this;
	}

	static function toString(self $method)
	{
		return $method->value;
	}
}
