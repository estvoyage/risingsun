<?php namespace estvoyage\risingsun;

interface ofloat
{
	function recipientOfNFloatIs(nfloat\recipient $recipient);
	function recipientOfOFloatWithNFloatIs(float $nfloat, ofloat\recipient $recipient);
}
