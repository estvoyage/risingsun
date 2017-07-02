<?php namespace estvoyage\risingsun\tests\units\providers\comparison;

use estvoyage\risingsun\tests\units\tools;

trait greaterThan
{
	use tools\comparison\provider\negate, lessThan {
		lessThan::okProvider as lessThanProvider;
		lessThan::koProvider as notLessThanProvider;
	}

	protected function okProvider()
	{
		return self::negate($this->lessThanProvider());
	}

	protected function koProvider()
	{
		return self::negate($this->notLessThanProvider());
	}
}
