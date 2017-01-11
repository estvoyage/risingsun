<?php namespace estvoyage\risingsun\output\stream\collection;

use estvoyage\{ risingsun, risingsun\output };

interface payload
{
	function currentStreamOfIteratorIs(risingsun\iterator $iterator, output\stream $stream);
}
