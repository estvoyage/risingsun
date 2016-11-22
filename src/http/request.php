<?php namespace estvoyage\risingsun\http;

use
	estvoyage\risingsun\hash
;

interface request
{
	function recipientOfHttpMethodIs(method\recipient $recipient);
	function recipientOfHttpRequestUrlPathIs(request\url\path\recipient $recipient);
	function recipientOfHttpRequestHashKeyIs(request\hash\key\recipient $recipient);
}
