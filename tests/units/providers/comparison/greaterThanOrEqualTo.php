<?php namespace estvoyage\risingsun\tests\units\providers\comparison;

use estvoyage\risingsun\tests\units\tools;

trait greaterThanOrEqualTo
{
	use tools\comparison\provider\negate, lessThanOrEqualTo {
		lessThanOrEqualTo::okProvider as lessThanOrEqualToProvider;
		lessThanOrEqualTo::koProvider as notLessThanOrEqualToProvider;
	}

	protected function okProvider()
	{
		return self::negate($this->lessThanOrEqualToProvider());
	}

	protected function koProvider()
	{
		return self::negate($this->notLessThanOrEqualToProvider());
	}
}
