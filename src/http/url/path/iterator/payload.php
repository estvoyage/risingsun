<?php namespace estvoyage\risingsun\http\url\path\iterator;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http\url
;

interface payload
{
	function currentHttpUrlPathOfIteratorIs(url\path\iterator $iterator, url\path $path);
}
