<?php namespace estvoyage\risingsun\http\method;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http
;

class get extends http\method
{
	function __construct()
	{
		parent::__construct(new risingsun\ostring\notEmpty('GET'));
	}
}
