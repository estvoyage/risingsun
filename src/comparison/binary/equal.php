<?php namespace estvoyage\risingsun\comparison\binary;

use estvoyage\risingsun\{ comparison, oboolean };

class equal
	implements
		comparison\binary
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

	function recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, oboolean\recipient $recipient)
	{
		$recipient->obooleanIs($firstOperand == $secondOperand ? $this->ok : $this->ko);

		return $this;
	}
}
