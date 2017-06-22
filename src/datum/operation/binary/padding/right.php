<?php namespace estvoyage\risingsun\datum\operation\binary\padding;

use estvoyage\risingsun\{ datum, ointeger, nstring };

class right extends datum\operation\binary\any
{
	function __construct(datum $template, ointeger\unsigned $length)
	{
		parent::__construct($template, new nstring\operation\binary\padding\right($length));
	}
}
