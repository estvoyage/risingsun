<?php

require __DIR__ . '/../vendor/autoload.php';

use
	estvoyage\risingsun\{runner, http, block, output, ostring, iterator}
;

(
 	new runner(new output\console(new output\stdout, new output\stream\formater\endOfLine))
)
	->blockIs(
		new block\iterator(
			new iterator\fifo,
			new block\collection(
				new block\functor(
					function($output)
					{
						(
							new http\route\post(
								new http\route\stream(
									new output\stream('Hello, POST!')
								)
							)
						)
							->recipientOfHttpResponseForRequestIs(
								new http\request\v1_1(
									new http\method\post,
									new http\url\path(new ostring\notEmpty('/' . uniqid()))
								),
								new http\response\recipient\output(
									$output
								)
							)
						;
					}
				),
				new block\functor(
					function($output)
					{
						(
							new http\route\directory(
								new http\url\path(
									new ostring\notEmpty('/foo')
								),
								new http\route\stream(
									new output\stream('Hello, /foo!')
								)
							)
						)
							->recipientOfHttpResponseForRequestIs(
								new http\request\v1_1(
									new http\method\post,
									new http\url\path(
										new ostring\notEmpty('/foo')
									)
								),
								new http\response\recipient\output(
									$output
								)
							)
						;
					}
				),
				new block\functor(
					function($output)
					{
						(
							new http\route\post(
								new http\route\directory(
									new http\url\path(
										new ostring\notEmpty('/bar')
									),
									new http\route\stream(
										new output\stream('Hello, POST to /bar!')
									)
								)
							)
						)
							->recipientOfHttpResponseForRequestIs(
								new http\request\v1_1(
									new http\method\post,
									new http\url\path(
										new ostring\notEmpty('/bar')
									)
								),
								new http\response\recipient\output(
									$output
								)
							)
						;
					}
				),
				new block\functor(
					function($output)
					{
						(
							new http\route\post(
								new http\route\iterator(
									new iterator\fifo,
									new http\route\directory(
										new http\url\path(
											new ostring\notEmpty('/foo/bar')
										),
										new http\route\stream(
											new output\stream('Hello, POST to /foo/bar!')
										)
									),
									new http\route\directory(
										new http\url\path(
											new ostring\notEmpty('/foo')
										),
										new http\route\stream(
											new output\stream('Hello, POST to /foo!')
										)
									),
									new http\route\directory(
										new http\url\path(
											new ostring\notEmpty('/bar')
										),
										new http\route\stream(
											new output\stream('Hello, POST to /bar!')
										)
									)
								)
							)
						)
							->recipientOfHttpResponseForRequestIs(
								new http\request\v1_1(
									new http\method\post,
									new http\url\path(
										new ostring\notEmpty('/foo/bar')
									)
								),
								new http\response\recipient\output(
									$output
								)
							)
						;
					}
				),
				new block\functor(
					function($output)
					{
						(
							new http\route\post(
								new http\route\iterator(
									new iterator\fifo,
									new http\route\directory(
										new http\url\path(new ostring\notEmpty('/foo')),
										new http\route\iterator(
											new iterator\fifo,
											new http\route\file\stream(new http\url\path(new ostring\notEmpty('/')), new output\stream('Hello, POST to /foo!')),
											new http\route\file\stream(new http\url\path(new ostring\notEmpty('/bar')), new output\stream('Hello, other POST to /foo/bar!'))
										)
									),
									new http\route\directory(
										new http\url\path(new ostring\notEmpty('/oof')),
										new http\route\iterator(
											new iterator\fifo,
											new http\route\file\stream(new http\url\path(new ostring\notEmpty('/')), new output\stream('Hello, POST to /oof!')),
											new http\route\file\stream(new http\url\path(new ostring\notEmpty('/rab')), new output\stream('Hello, POST to /oof/rab!'))
										)
									)
								)
							)
						)
							->recipientOfHttpResponseForRequestIs(
								new http\request\v1_1(
									new http\method\post,
									new http\url\path(
										new ostring\notEmpty('/oof/rab')
									)
								),
								new http\response\recipient\output(
									$output
								)
							)
						;
					}
				)
			)
		)
	)
;
