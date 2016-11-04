<?php namespace estvoyage\risingsun\ostring;

use
	estvoyage\risingsun
;

interface pattern
{
	function recipientOfHashWithPatternDataFromStringIs(risingsun\hash $hash, risingsun\ostring $string, pattern\data\recipient $recipient);
	function ifIsPatternOfString(risingsun\ostring $ostring, risingsun\block $matchBlock, risingsun\block $notMatchBlock = null);
	function ifIsNotPatternOfString(risingsun\ostring $ostring, risingsun\block $block);
}
