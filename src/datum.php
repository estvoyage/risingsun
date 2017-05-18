<?php namespace estvoyage\risingsun;

interface datum
{
	function recipientOfNStringIs(nstring\recipient $recipient) :void;
	function recipientOfDatumWithNStringIs(string $value, datum\recipient $recipient) :void;
	function recipientOfDatumLengthIs(datum\length\recipient $recipient) :void;
}
