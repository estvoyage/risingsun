<?php namespace estvoyage\risingsun\http\request\v1_1;

use
	estvoyage\risingsun\http
;

class post extends http\request\v1_1
{
	function __construct(http\url\path $path)
	{
		parent::__construct(new http\method\post, $path);
	}
}
