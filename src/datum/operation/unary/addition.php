<?php namespace estvoyage\risingsun\datum\operation\unary;

use estvoyage\risingsun\{ datum\operation, datum, block\functor };

class addition extends operation\unary\any
{
	function __construct(datum $template, datum $suffix)
	{
		parent::__construct($suffix, new operation\binary\addition($template));
	}
}
