<?php namespace estvoyage\risingsun;

interface ointeger
{
	function recipientOfNIntegerIs(ninteger\recipient $recipient);
	function recipientOfOIntegerWithValueIs(int $value, ointeger\recipient $recipient);
	function recipientOfOperationWithOIntegerIs(ointeger\operation\binary $operation, ointeger $ointeger, ointeger\recipient $recipient);
	function recipientOfComparisonWithOIntegerIs(ointeger\comparison $comparison, ointeger $ointeger, oboolean\recipient $recipient);
}
