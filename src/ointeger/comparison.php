<?php namespace estvoyage\risingsun\ointeger;

use estvoyage\risingsun\{ ointeger, oboolean, block };

interface comparison
{
	function recipientOfComparisonBetweenOIntegersIs(ointeger $firstOperand, ointeger $secondOperand, oboolean\recipient $recipient);
	function blockForComparisonBetweenOIntegersIs(ointeger $firstOperand, ointeger $secondOperand, block $block);
}
