<?php namespace estvoyage\risingsun\http;

use
	estvoyage\risingsun
;

interface response
{
	function recipientOfHttpResponseBodyIsOutput(risingsun\output $output);
}
