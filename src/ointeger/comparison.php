<?php namespace estvoyage\risingsun\ointeger;

use estvoyage\risingsun\{ ointeger, oboolean };

interface comparison
{
	function recipientOfComparisonBetweenOIntegersIs(ointeger $firstOperand, ointeger $secondOperand, oboolean\recipient $recipient);
}
