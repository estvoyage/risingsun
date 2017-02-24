<?php namespace estvoyage\risingsun\block\proxy\oboolean;

use estvoyage\risingsun\{ block, oboolean };

class recipient
	implements
		block
{
	private
		$recipient,
		$oboolean
	;

	function __construct(oboolean\recipient $recipient, oboolean $oboolean)
	{
		$this->recipient = $recipient;
		$this->oboolean = $oboolean;
	}

	function blockArgumentsAre(... $arguments)
	{
		$this->recipient->obooleanIs($this->oboolean);

		return $this;
	}
}
