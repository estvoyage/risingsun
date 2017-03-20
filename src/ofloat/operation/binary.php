<?php namespace estvoyage\risingsun\ofloat\operation;

use estvoyage\risingsun\ofloat;

interface binary
{
	function recipientOfOperationOnOFloatsIs(ofloat $firstOperand, ofloat $secondOperand, ofloat\recipient $recipient);
}
