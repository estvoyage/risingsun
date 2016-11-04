<?php namespace estvoyage\risingsun\ofloat\part\decimal;

use
	estvoyage\risingsun
;

class precision extends risingsun\ointeger\unsigned
{
	function __construct($value)
	{
		parent::__construct($value);

		$this
			->ifIsEqualTo(
				new risingsun\ointeger\unsigned,
				new risingsun\block\exception\domain(
					new risingsun\ostring\notEmpty(
						'Decimal part precision must be greater than 0'
					)
				)
			)
		;
	}
}
