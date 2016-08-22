<?php namespace estvoyage\risingsun\hash\key;

use
	estvoyage\risingsun\hash
;

interface recipient
{
	function hashKeyIs(hash\key $key);
}
