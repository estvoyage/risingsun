<?php namespace estvoyage\risingsun\block;

use estvoyage\risingsun\block;

class error
	implements
		block
{
	private
		$error
	;

	function __construct(\error $error)
	{
		$this->error = $error;
	}

	function blockArgumentsAre(... $arguments)
	{
		throw $this->error;
	}
}
