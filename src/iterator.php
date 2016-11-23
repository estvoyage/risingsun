<?php namespace estvoyage\risingsun;

interface iterator
{
	function iteratorPayloadForValuesIs(array $values, iterator\payload $payload);
	function nextIteratorValuesAreUseless();
}
