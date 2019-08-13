# PHP QIF Library

A far from feature complete library for writing QIF files in PHP.


## Installation

```
composer require stephenharris/phpqif
```

## Usage

### Writer
```php
// Instatiate the QIF Writer
$qif = new StephenHarris\QIF\Writer();

// Create a new transaction
$transaction = new Transaction( Transaction::CASH );

$transaction->setDate( new \DateTime( '2017-12-31' ) )
	->setDescription( 'invoice-123: Some Payment' )
	->setAmount( 68.99 )
	->setCategory( 'Sales' )
	->addSplit( 'Sales', 60 )
	->addSplit( 'Fee', -3.01 )
	->addSplit( 'Tax', 12 )
	->markReconciled();

// Add it to the QIF
$qif->addTransaction( $transaction );

echo $qif;
```

### Parser

```php
// Instatiate the QIF Writer
$qifParser = new StephenHarris\QIF\Parser( $filePath );
$qifParser->parse();

foreach( $qifParser->getTransactions() as $transaction )
{
    // your code
}
```
