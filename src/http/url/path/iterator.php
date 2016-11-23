<?php namespace estvoyage\risingsun\http\url\path;

use
	estvoyage\risingsun\http\url
;

interface iterator
{
	function httpUrlPathIteratorPayloadIs(iterator\payload $payload);
	function nextHttpUrlPathAreUseless();
	function recipientOfHttpUrlPathIteratorWithPathIs(url\path $path, iterator\recipient $recipient);
}
