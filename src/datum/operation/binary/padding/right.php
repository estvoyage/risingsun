<?php namespace estvoyage\risingsun\datum\operation\binary\padding;

use estvoyage\risingsun\{ datum\operation, ointeger, nstring };

class right extends operation\binary\any
{
	function __construct(ointeger\unsigned $length)
	{
		parent::__construct(new nstring\operation\binary\padding\right($length));
	}
}
