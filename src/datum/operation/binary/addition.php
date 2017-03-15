<?php namespace estvoyage\risingsun\datum\operation\binary;

use estvoyage\risingsun\nstring;

class addition extends any
{
	function __construct()
	{
		parent::__construct(new nstring\operation\binary\addition);
	}
}
