<?php namespace estvoyage\risingsun;

interface ointeger extends datum
{
	function recipientOfNIntegerIs(ninteger\recipient $recipient);
	function recipientOfOIntegerWithNIntegerIs(int $value, ointeger\recipient $recipient);
}
