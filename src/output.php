<?php namespace estvoyage\risingsun;

interface output
{
	function outputStreamIs(output\stream $stream);
	function endOfLine();
}
