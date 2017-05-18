<?php namespace estvoyage\risingsun\comparison\binary;

class greaterThan extends not
{
	function __construct()
	{
		parent::__construct(new lessThanOrEqualTo);
	}
}
