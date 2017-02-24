<?php namespace estvoyage\risingsun\oboolean\recipient;

use estvoyage\risingsun\{ oboolean, block\functor };

class forward
	implements
		oboolean\recipient
{
	private
		$recipient,
		$forward
	;

	function __construct(oboolean\recipient $recipient, oboolean $forward)
	{
		$this->recipient = $recipient;
		$this->forward = $forward;
	}

	function obooleanIs(oboolean $oboolean)
	{
		$oboolean
			->blockForTrueIs(
				new functor(
					function()
					{
						$this->recipient->obooleanIs($this->forward);
					}
				)
			)
		;

		return $this;
	}
}
