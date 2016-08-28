<?php namespace estvoyage\risingsun;

interface hash
{
	function recipientOfHashValueAtKeyIs(hash\key $key, hash\value\recipient $recipient);
	function recipientOfHashWithValueIs(hash\value $value, hash\recipient $recipient);
}
