<?php

require __DIR__ . '/../../vendor/autoload.php';

use estvoyage\risingsun\{ ostring, block };

(new ostring('foo'))
	->recipientForStringOperationWithOperandIs(
		new ostring\operation\binary\addition,
		new ostring('bar'),
		new ostring\recipient\block(
			new block\functor(
				function($string) {
					$string
						->recipientForStringOperationIs(
							new ostring\operation\unary\revert,
							new ostring\recipient\block(
								new block\functor(
										function($string) {
											echo $string . PHP_EOL;
										}
									)
								)
							)
					;
				}
			)
		)
	)
;

