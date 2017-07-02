<?php namespace estvoyage\risingsun\tests\units\tools\comparison\provider;

trait negate
{
	private static function negate(array $data)
	{
		foreach ($data as & $arguments)
		{
			if (sizeof($arguments) == 2 && array_key_exists(0, $arguments) && array_key_exists(1, $arguments))
			{
				$tmp = $arguments[0];
				$arguments[0] = $arguments[1];
				$arguments[1] = $tmp;
			}
		}

		return $data;
	}
}
