<?php namespace estvoyage\risingsun\comparison\recipient;

use estvoyage\risingsun\comparison;

class not
	implements
		comparison\recipient
{
	private
		$recipient
	;

	function __construct(comparison\recipient $recipient)
	{
		$this->recipient = $recipient;
	}

	function nbooleanIs(bool $bool)
	{
		$this->recipient->nbooleanIs(! $bool);
	}
}
