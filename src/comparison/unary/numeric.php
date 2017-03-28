<?php namespace estvoyage\risingsun\comparison\unary;

use estvoyage\risingsun\{ comparison, oboolean };

class numeric
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

	function recipientOfComparisonWithValueIs($value, oboolean\recipient $recipient)
	{
		is_numeric($value)
			?
			$recipient->obooleanIs($this->ok)
			:
			$recipient->obooleanIs($this->ko)
		;

		return $this;
	}
}
