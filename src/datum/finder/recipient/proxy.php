<?php namespace estvoyage\risingsun\datum\finder\recipient;

use estvoyage\risingsun\{ datum\finder, ointeger, block };

class proxy
	implements
		finder\recipient
{
	private
		$recipient,
		$block
	;

	function __construct(ointeger\recipient $recipient, block $block)
	{
		$this->recipient = $recipient;
		$this->block = $block;
	}

	function datumIsAtPosition(ointeger\unsigned $position)
	{
		$this->recipient->ointegerIs($position);

		return $this;
	}

	function datumDoesNotExist()
	{
		$this->block->blockArgumentsAre();

		return $this;
	}
}
