<?php namespace estvoyage\risingsun\http;

use
	estvoyage\risingsun\hash
;

interface request
{
	function recipientOfHashKeyIs(hash\key\recipient $recipient);
}
