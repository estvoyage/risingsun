<?php namespace estvoyage\risingsun\ostring\pattern;

use
	estvoyage\risingsun
;

class pcre extends risingsun\ostring
	implements risingsun\ostring\pattern
{
	private
		$names,
		$matches
	;

	function __construct($value, data\name... $names)
	{
		parent::__construct($value);

		$this->names = $names;
	}

	function stringHasController(risingsun\ostring $string, controller $controller)
	{
		$pattern = clone $this;

		$previousErrorHandler = set_error_handler(function($errno, $errstr) use (& $errorMessage) { $errorMessage = $errstr; return true; });

		$match = preg_match($pattern, $string, $matches);

		set_error_handler($previousErrorHandler);

		switch (true)
		{
			case $match === false:
				throw new \domainException('Pattern \'' . $this . '\' is not a valid PCRE regular expression: ' . $errorMessage);

			case ! $match:
				$controller->stringNotMatchPattern($string, $this);
				break;

			default:
				$match = new match($matches[0]);

				if ($pattern->names)
				{
					unset($matches[0]);

					$pattern->matches = array_slice($matches, 0, sizeof(sizeof($pattern->names) <= sizeof($matches) ? $pattern->names : $matches));
					$pattern->names = array_slice($pattern->names, 0, sizeof($pattern->matches));
				}

				$controller->stringMatchPattern($match, $pattern);
		}

		return $this;
	}

	function recipientOfStringPatternDataIs(data\recipient $recipient)
	{
		if ($this->matches)
		{
			foreach ($this->names as $key => $name)
			{
				$recipient = $recipient->stringPatternDataHasName(new data($this->matches[$key]), $name);
			}
		}

		return $this;
	}
}
