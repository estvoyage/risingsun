<?php

require __DIR__ . '/../vendor/autoload.php';

use
	estvoyage\risingsun\http,
	estvoyage\risingsun\block,
	estvoyage\risingsun\ostring
;

(
	new http\route\post(
		new class
			implements
				http\route
		{
			function recipientOfHttpUrlPathIs(http\url\path\recipient $recipient)
			{
			}

			function httpRouteControllerHasRequest(http\route\controller $controller, http\request $request)
			{
				$controller->httpResponseIs(
					new class
						implements
							http\response
					{
					}
				);
			}
		}
	)
)
	->httpRouteControllerHasRequest(
		new class
			implements http\route\controller
		{
			function httpResponseIs(http\response $response)
			{
				var_dump($response);
			}
		},
		new http\request\v1_1(
			new http\method\post,
			new http\url\path(new ostring\notEmpty('/'))
		)
	)
;

(
	new http\route\get(
		new class
			implements
				http\route
		{
			function recipientOfHttpUrlPathIs(http\url\path\recipient $recipient)
			{
			}

			function httpRouteControllerHasRequest(http\route\controller $controller, http\request $request)
			{
				$controller->httpResponseIs(
					new class
						implements
							http\response
					{
					}
				);
			}
		}
	)
)
	->httpRouteControllerHasRequest(
		new class
			implements http\route\controller
		{
			function httpResponseIs(http\response $response)
			{
				var_dump($response);
			}
		},
		new http\request\v1_1(
			new http\method\post,
			new http\url\path(new ostring\notEmpty('/'))
		)
	)
;
