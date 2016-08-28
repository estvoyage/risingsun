<?php namespace estvoyage\risingsun\http;

use
	estvoyage\risingsun\hash
;

interface request
{
	function recipientOfHashKeyIs(request\hash\key\recipient $recipient);
}
