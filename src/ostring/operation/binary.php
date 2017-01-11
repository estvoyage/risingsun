<?php namespace estvoyage\risingsun\ostring\operation;

use estvoyage\risingsun;

interface binary
{
	function recipientForStringOperandAndStringOperandIs(risingsun\ostring $operand1, risingsun\ostring $operand2, risingsun\ostring\recipient $recipient);
}
