<?php namespace estvoyage\risingsun\datum\operation\unary\padding;

use estvoyage\risingsun\{ datum\operation, datum, ointeger };

class right extends operation\unary\any
{
	function __construct(datum $template, ointeger\unsigned $length, datum $padding)
	{
		parent::__construct($padding, new operation\binary\padding\right($template, $length));
	}
}
