<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun\http
;

interface endpoint
{
	function recipientOfHttpResponseForRequestIs(http\request $request, http\response\recipient $recipient);
}
