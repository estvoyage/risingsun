<?php namespace estvoyage\risingsun\ofloat\operation;

use estvoyage\risingsun\ofloat;

interface unary
{
	function recipientOfOperationWithOFloatIs(ofloat $operand, ofloat\recipient $recipient);
}
