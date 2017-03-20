<?php namespace estvoyage\risingsun;

interface datum
{
	function recipientOfNStringIs(nstring\recipient $recipient);
	function recipientOfDatumWithNStringIs(string $value, datum\recipient $recipient);
	function recipientOfDatumLengthIs(ointeger\unsigned\recipient $recipient);
}
