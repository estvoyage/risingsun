<?php

require __DIR__ . '/../vendor/autoload.php';

use
	estvoyage\risingsun\http,
	estvoyage\risingsun\block,
	estvoyage\risingsun\output,
	estvoyage\risingsun\ostring
;

(
	new http\route\post(
		new http\route\endpoint(
			new http\response\stream(
				new output\stream('POST!')
			)
		)
	)
)
	->httpRouteControllerHasRequest(
		new http\route\controller\output($output = new output\stdout),
		new http\request\v1_1(
			new http\method\post,
			new http\url\path(new ostring\notEmpty('/' . uniqid()))
		)
	)
;

$output->endOfLine();

(
	new http\route\path(
		new http\url\path(
			new ostring\notEmpty('/foo')
		),
		new http\route\endpoint(
			new http\response\stream(
				new output\stream('Foo!')
			)
		)
	)
)
	->httpRouteControllerHasRequest(
		new http\route\controller\output(
			$output
		),
		new http\request\v1_1(
			new http\method\post,
			new http\url\path(
				new ostring\notEmpty('/foo')
			)
		)
	)
;

$output->endOfLine();

(
	new http\route\post(
		new http\route\path(
			new http\url\path(
				new ostring\notEmpty('/bar')
			),
			new http\route\endpoint(
				new http\response\stream(
					new output\stream('POST to /bar!')
				)
			)
		)
	)
)
	->httpRouteControllerHasRequest(
		new http\route\controller\output(
			$output
		),
		new http\request\v1_1(
			new http\method\post,
			new http\url\path(
				new ostring\notEmpty('/bar')
			)
		)
	)
;

$output->endOfLine();

(
	new http\route\post(
		new http\route\node(
			new http\route\path(
				new http\url\path(
					new ostring\notEmpty('/foo')
				),
				new http\route\endpoint(
					new http\response\stream(
						new output\stream('POST to /foo!')
					)
				)
			),
			new http\route\path(
				new http\url\path(
					new ostring\notEmpty('/foo/bar')
				),
				new http\route\endpoint(
					new http\response\stream(
						new output\stream('POST to /foo/bar!')
					)
				)
			),
			new http\route\path(
				new http\url\path(
					new ostring\notEmpty('/bar')
				),
				new http\route\endpoint(
					new http\response\stream(
						new output\stream('POST to /bar!')
					)
				)
			)
		)
	)
)
	->httpRouteControllerHasRequest(
		new http\route\controller\output(
			$output
		),
		new http\request\v1_1(
			new http\method\post,
			new http\url\path(
				new ostring\notEmpty('/foo/bar')
			)
		)
	)
;

$output->endOfLine();

(
	new http\route\post(
		new http\route\path(
			new http\url\path(
				new ostring\notEmpty('/foo')
			),
			new http\route\node(
				new http\route\path(
					new http\url\path(
						new ostring\notEmpty('/')
					),
					new http\route\endpoint(
						new http\response\stream(
							new output\stream('POST to /foo!')
						)
					)
				),
				new http\route\path(
					new http\url\path(
						new ostring\notEmpty('/bar')
					),
					new http\route\endpoint(
						new http\response\stream(
							new output\stream('other POST to /foo/bar!')
						)
					)
				)
			)
		)
	)
)
	->httpRouteControllerHasRequest(
		new http\route\controller\output(
			$output
		),
		new http\request\v1_1(
			new http\method\post,
			new http\url\path(
				new ostring\notEmpty('/foo')
			)
		)
	)
;
