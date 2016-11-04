<?php namespace estvoyage\risingsun\http\url\path;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http\url
;

class root extends url\path
{
	function __construct()
	{
		parent::__construct(new risingsun\ostring\notEmpty('/'));
	}
}
