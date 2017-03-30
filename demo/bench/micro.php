<?php

require __DIR__ . '/../../vendor/autoload.php';

use estvoyage\risingsun\{ bench, time\duration, block, time };

(new bench\micro)
	->recipientOfDurationForBlockIs(
		new block\functor(
			function()
			{
			}
		),
		new time\duration\recipient\functor(
			function($duration)
			{
				var_dump($duration);
			}
		)
	)
;
