<?php namespace estvoyage\risingsun\comparison;

use estvoyage\risingsun\{ comparison, oboolean };

class lessThanOrEqualTo
	implements
		comparison
{
	private
		$firstoperand,
		$secondoperand,
		$oboolean
	;

	function __construct($firstoperand, $secondoperand = 0, oboolean $oboolean = null)
	{
		$this->firstoperand = $firstoperand;
		$this->secondoperand = $secondoperand;
		$this->oboolean = $oboolean ?: new oboolean\ok;
	}

	function recipientofcomparisonis(oboolean\recipient $recipient)
	{
		if ($this->firstoperand <= $this->secondoperand)
		{
			$recipient->obooleanis($this->oboolean);
		}

		return $this;
	}
}
