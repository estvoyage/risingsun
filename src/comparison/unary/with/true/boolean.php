<?php namespace estvoyage\risingsun\comparison\unary\with\true;

use estvoyage\risingsun\{ comparison, oboolean\recipient, oboolean };

class boolean
	implements
		comparison\unary
{
	private
		$ok,
		$ko
	;

	function __construct(oboolean $ok = null, oboolean $ko = null)
	{
		$this->ok = $ok ?: new oboolean\ok;
		$this->ko = $ko ?: new oboolean\ko;
	}

	function recipientOfComparisonWithValueIs($value, recipient $recipient)
	{
		$recipient->obooleanIs($value === true ? $this->ok : $this->ko);

		return $this;
	}
}
