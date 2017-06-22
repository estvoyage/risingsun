<?php

require __DIR__ . '/../../vendor/autoload.php';

use estvoyage\risingsun\{ bench, time\duration, block, datum, ostring, output };

(new bench\micro)
	->recipientOfDurationForBlockIs(
		new block\functor(
			function() {
				sleep(1);
			}
		),
		new duration\recipient\functor(
			function($duration)
			{
				(new duration\formater\seconde(new datum\operation\unary\addition(new ostring\any, new ostring\any(' s' . PHP_EOL))))
					->outputForDurationIs($duration, new output\stdout)
				;
			}
		)
	)
;
