<?php

namespace estvoyage\risingsun\tests\units;

if (defined('atoum\scripts\runner') === false)
{
	define('atoum\scripts\runner', __FILE__);
}

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../vendor/atoum/atoum/scripts/runner.php';
require_once __DIR__ . '/test.php';

ini_set('include_path', '.:' . __DIR__);
