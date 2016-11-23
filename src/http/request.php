<?php namespace estvoyage\risingsun\http;

use
	estvoyage\risingsun\hash
;

interface request
{
	function recipientOfHttpMethodIs(method\recipient $recipient);
	function recipientOfHttpUrlPathIs(url\path\recipient $recipient);
}
