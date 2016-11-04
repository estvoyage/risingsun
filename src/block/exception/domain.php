<?php namespace estvoyage\risingsun\block\exception;

use
	estvoyage\risingsun
;

class domain
	implements
		risingsun\block
{
	private
		$message
	;

	function __construct(risingsun\ostring\notEmpty $message)
	{
		$this->message = $message;
	}

	function blockArgumentsAre(... $arguments)
	{
		throw new \domainException($this->message);
	}
}
