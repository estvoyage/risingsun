<?php namespace estvoyage\risingsun\http\method;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http
;

class post extends http\method
{
	function __construct()
	{
		parent::__construct(new risingsun\ostring\notEmpty('POST'));
	}
}
