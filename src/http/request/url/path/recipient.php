<?php namespace estvoyage\risingsun\http\request\url\path;

use
	estvoyage\risingsun\http
;

interface recipient
{
	function httpRequestUrlPathIs(http\url\path $path);
}
