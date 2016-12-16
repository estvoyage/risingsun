<?php namespace estvoyage\risingsun\http;

use
	estvoyage\risingsun\hash
;

interface route
{
	function recipientOfHttpResponseForRequestIs(request $request, response\recipient $recipient);
	function recipientOfHttpUrlPathIs(url\path\recipient $recipient);
}
