<?php namespace estvoyage\risingsun\datum\operation\unary\container;

use estvoyage\risingsun\datum\{ operation\unary as operation, operation\unary\container };

class collection
	implements
		container
{
	private
		$operations
	;

	function __construct(operation... $operations)
	{
		$this->operations = $operations;
	}

	function payloadForUnaryDatumOperationContainerIteratorIs(container\iterator $iterator, container\payload $payload)
	{
		$iterator->unaryDatumOperationsForPayloadAre($payload, ... $this->operations);

		return $this;
	}
}
