<?php namespace estvoyage\risingsun\comparison\unary;

use estvoyage\risingsun\{ comparison, oboolean\recipient, oboolean };

class isFloat
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
		$recipient->obooleanIs(is_float($value) ? $this->ok : $this->ko);

		return $this;
	}
}
