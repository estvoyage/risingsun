<?php namespace estvoyage\risingsun;

interface oboolean
{
	function recipientOfNBooleanIs(comparison\recipient $recipient) :void;
	function recipientOfOBooleanWithNBooleanIs(bool $nboolean, oboolean\recipient $recipient) :void;
}
