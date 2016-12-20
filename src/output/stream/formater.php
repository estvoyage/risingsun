<?php namespace estvoyage\risingsun\output\stream;

use
	estvoyage\risingsun\output
;

interface formater
{
	function recipientOfOutputStreamWithEndOfLineIs(output\stream $stream, output\stream\recipient $recipient);
}
