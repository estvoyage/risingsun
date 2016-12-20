<?php namespace estvoyage\risingsun\http\route\file;

use
	estvoyage\risingsun\http,
	estvoyage\risingsun\output
;

class stream extends http\route\file
{
	function __construct(http\url\path $path, output\stream $stream)
	{
		parent::__construct($path, new http\route\stream($stream));
	}
}
