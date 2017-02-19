<?php namespace estvoyage\risingsun;

interface output
{
	function nstringIs(string $nstring);
	function endOfLine();
	function outputLineIs(ostring $ostring);
}
