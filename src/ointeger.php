<?php namespace estvoyage\risingsun;

interface ointeger extends datum
{
	function recipientOfNIntegerIs(ninteger\recipient $recipient);
	function recipientOfOIntegerWithNIntegerIs(int $value, ointeger\recipient $recipient);
	function recipientOfOIntegerWithOIntegerIs(ointeger $ointeger, ointeger\recipient $recipient);
}
