<?php namespace estvoyage\risingsun\time\duration\timestamp\unix\micro\operation;

use estvoyage\risingsun\time\duration\timestamp\unix\micro as timestamp;

interface binary
{
	function recipientOfOperationOnMicroUnixTimestampsIs(timestamp $firstOperand, timestamp $secondOperand, timestamp\recipient $recipient);
}
