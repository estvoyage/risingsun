<?php namespace estvoyage\risingsun\comparison\binary;

class greaterThanOrEqualTo extends not
{
	function __construct()
	{
		parent::__construct(new lessThan);
	}
}
