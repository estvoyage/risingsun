<?php namespace estvoyage\risingsun\block;

use estvoyage\risingsun\{ block, oboolean };

class error
	implements
		block,
		oboolean\recipient
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

	function obooleanIs(oboolean $oboolean)
	{
		$oboolean->blockForTrueIs($this);

		return $this;
	}
}
