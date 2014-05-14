<?php

class ApiOpenBadgesIssuer extends ApiBase {

	public function getDescription() {
		return 'Get json with information on this issuer of OpenBadges.';
	}

	public function getVersion() {
		return __CLASS__ . ': $Id$';
	}

	public function isReadMode() {
		return true;
	}

	public function execute() {
		global $wgServer, $wgSitename;

		$this->getResult()->addValue( null, 'name', $wgSitename );
		$this->getResult()->addValue( null, 'url',  $wgServer );
	}
}
