<?php namespace estvoyage\risingsun\datum;

use estvoyage\risingsun\datum;

interface finder
{
	function recipientOfSearchOfDatumInDatumIs(datum $search, datum $datum, datum\finder\recipient $recipient);
}
