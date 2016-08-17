<?php namespace estvoyage\risingsun\ostring;

use
	estvoyage\risingsun
;

interface pattern
{
	function stringHasController(risingsun\ostring $string, pattern\controller $controller);
	function recipientOfStringPatternDataIs(pattern\data\recipient $recipient);
}
