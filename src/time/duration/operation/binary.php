<?php namespace estvoyage\risingsun\time\duration\operation;

use estvoyage\risingsun\time\duration;

interface binary
{
	function durationRecipientForOperationWithDurationAndDurationIs(duration $firstOperand, duration $secondOperand, duration\recipient $recipient);
}
