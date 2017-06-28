<?php
namespace StephenHarris\QIF;

class Writer {

	private $transactions = [];

	public function addTransaction( Transaction $transaction ) {
		$this->transactions[] = $transaction;
	}

	public function __toString() {
		$output = [];

		foreach ( $this->transactions as $transaction ) {
			$output[] = (string) $transaction;
		}

		return implode( PHP_EOL, array_filter( $output ) );
	}

}
