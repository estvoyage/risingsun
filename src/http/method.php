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

	function ifIsEqualToHttpMethod(self $method, callable $callable)
	{
		$method->value->ifEqualToString($this->value, $callable);

		return $this;
	}
}
