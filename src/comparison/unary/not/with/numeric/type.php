<?php namespace estvoyage\risingsun\comparison\unary\not\with\numeric;

use estvoyage\risingsun\comparison;

class type extends comparison\unary\not
{
	function __construct()
	{
		parent::__construct(new comparison\unary\with\numeric\type);
	}
}
