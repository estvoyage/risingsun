<?php namespace estvoyage\risingsun\comparison\unary\not;

use estvoyage\risingsun\comparison;

class blank extends comparison\unary\not
{
	function __construct()
	{
		parent::__construct(new comparison\unary\blank);
	}
}
