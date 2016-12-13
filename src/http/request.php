<?php namespace estvoyage\risingsun\http;

use
	estvoyage\risingsun\iterator
;

interface request
{
	function recipientOfHttpMethodIs(method\recipient $recipient);
	function recipientOfHttpUrlPathIs(url\path\recipient $recipient);
	function recipientOfSubRequestOfHttpUrlPathIs(url\path $path, request\recipient $recipient);
}
