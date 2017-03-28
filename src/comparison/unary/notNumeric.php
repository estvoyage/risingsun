<?php namespace estvoyage\risingsun\comparison\unary;

use estvoyage\risingsun\oboolean;

class notNumeric extends numeric
{
	function __construct(oboolean $ok = null, oboolean $ko = null)
	{
		parent::__construct($ko ?: new oboolean\ko, $ok ?: new oboolean\ok);
	}
}
