<?php namespace estvoyage\risingsun;

interface datum
{
	function recipientOfNStringIs(nstring\recipient $recipient) :void;
	function recipientOfDatumWithNStringIs(string $nstring, datum\recipient $recipient) :void;
	function recipientOfDatumFromDatumIs(self $datum, datum\recipient $recipient) :void;
}
