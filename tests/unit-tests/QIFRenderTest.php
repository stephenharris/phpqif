<?php
use StephenHarris\QIF\Transaction;
use StephenHarris\QIF\Writer;

class QIFRenderTest extends PHPUnit_Framework_TestCase {

	public function testRenderingCashTransaction() {
			$transaction = new Transaction(
				Transaction::CASH
			);

			$transaction->setDate( new \DateTime( '2017-12-31' ) )
				->setDescription( 'invoice-123: Some Payment' )
				->setAmount( 68.99 )
				->setCategory( 'Sales' )
				->addSplit( 'Sales', 60 )
				->addSplit( 'Tax', 12 )
				->addSplit( 'Fee', -3.01 )
				->markReconciled();

			$this->assertEquals(
				rtrim( file_get_contents( TEST_DATA_DIR . '/singleTransaction.qif') ),
				(string) $transaction
			);
	}

	public function testRenderingQIF() {

			$qif = new Writer();

			$qif->addTransaction( (new Transaction(Transaction::CASH ))
				->setDate( new \DateTime( '2016-11-01' ) )
				->setDescription( 'invoice-3027: Express Checkout Payment - #AMA63142DF230151S' )
				->setAmount( 9.33 )
				->setCategory( 'Express Checkout' )
				->addSplit( 'Express Checkout', 10 )
				->addSplit( 'Fee', -0.67 )
				->markReconciled()
			);

			$qif->addTransaction( (new Transaction(Transaction::CASH ))
				->setDate( new \DateTime( '2016-11-01' ) )
				->setDescription( 'invoice-3028: Express Checkout Payment - #93672946MA543893H' )
				->setAmount( 38.44 )
				->setCategory( 'Express Checkout' )
				->addSplit( 'Express Checkout', 40 )
				->addSplit( 'Fee',-1.56 )
				->markReconciled()
			);

			$qif->addTransaction( (new Transaction(Transaction::CASH))
				->setDate( new \DateTime( '2016-11-01' ) )
				->setDescription( 'invoice-123: Payment Refund - #5P432542KC758251V' )
				->setAmount( -9.48 )
				->setCategory( 'Express Checkout' )
				->addSplit( 'Express Checkout', -10 )
				->addSplit( 'Fee', 0.52 )
				->markReconciled()
			);


			$this->assertEquals(
				rtrim( file_get_contents( TEST_DATA_DIR . '/multipleTransactions.qif') ),
				(string) $qif
			);
	}

}
