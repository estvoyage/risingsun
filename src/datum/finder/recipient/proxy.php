<?php namespace estvoyage\risingsun\datum\finder\recipient;

use estvoyage\risingsun\{ datum\finder, ointeger, block };

class proxy
	implements
		finder\recipient
{
	private
		$datumExists,
		$datumNotExists
	;

	function __construct(ointeger\recipient $recipient, block $datumNotExists)
	{
		$this->recipient = $recipient;
		$this->datumNotExists = $datumNotExists;
	}

	function datumIsAtPosition(ointeger\unsigned $position)
	{
		$this->recipient->ointegerIs($position);

		return $this;
	}

	function datumDoesNotExist()
	{
		$this->datumNotExists->blockArgumentsAre();

		return $this;
	}
}
