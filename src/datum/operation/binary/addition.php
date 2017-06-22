<?php namespace estvoyage\risingsun\datum\operation\binary;

use estvoyage\risingsun\{ nstring, datum };

class addition extends any
{
	function __construct(datum $template)
	{
		parent::__construct($template, new nstring\operation\binary\addition);
	}
}
