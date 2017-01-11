<?php namespace estvoyage\risingsun\ostring\operation;

use estvoyage\risingsun;

interface unary
{
	function recipientForStringOperandIs(risingsun\ostring $operand, risingsun\ostring\recipient $recipient);
}
