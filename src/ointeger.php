<?php namespace estvoyage\risingsun;

interface ointeger extends datum
{
	function recipientOfNIntegerIs(ninteger\recipient $recipient);
	function recipientOfOIntegerWithValueIs(int $value, ointeger\recipient $recipient);
	function recipientOfOIntegerOperationWithOIntegerIs(ointeger\operation\binary $operation, ointeger $ointeger, ointeger\recipient $recipient);
	function recipientOfOIntegerOperationIs(ointeger\operation\unary $operation, ointeger\recipient $recipient);
	function recipientOfComparisonWithOIntegerIs(ointeger\comparison $comparison, ointeger $ointeger, oboolean\recipient $recipient);
	function blockForComparisonWithOIntegerIs(ointeger\comparison $comparison, ointeger $ointeger, block $block);
}
