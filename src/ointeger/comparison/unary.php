<?php namespace estvoyage\risingsun\ointeger\comparison;

use estvoyage\risingsun\{ ointeger, comparison };

interface unary
{
	function recipientOfComparisonWithOIntegerIs(ointeger $ointeger, comparison\recipient $recipient);
}
