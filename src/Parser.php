<?php


namespace StephenHarris\QIF;


use StephenHarris\QIF\Enums\DetailItems;
use Carbon\Carbon;

/**
 * Class Parser
 *
 * @author MimoGraphix <mimographix@gmail.com>
 * @copyright EpicFail | Studio
 * @package StephenHarris\QIF
 */
class Parser
{
    /**
     * @var string
     */
    private $fileContent;

    /**
     * @var string
     */
    private $separator;

    /**
     * @var array
     */
    private $transactions = [];

    public function __construct( $fileContent, $separator = "\r\n" )
    {
        $this->fileContent = $fileContent;
        $this->separator = $separator;
    }

    public static function parseFile( $filePath )
    {
        $parser = new self( file_get_contents( $filePath ) );
        $parser->parse();
        return $parser;
    }

    public function parse()
    {
        $line = strtok( $this->fileContent, $this->separator );

        $lastType = null;
        $transaction = new Transaction( $lastType );
        $transactionRaw = "";
        while ( $line !== false )
        {
            $transactionRaw .= $line . $this->separator;

            $first = substr( $line, 0, 1 );
            $line = substr( $line, 1 );
            switch ( $first )
            {
                case '!':   // Header
                    $lastType = trim( str_replace( "Type:", "", $line ) );
                    $transaction = new Transaction( $lastType );
                    $transactionRaw = "!Type:" . $lastType;
                    break;
                case DetailItems::D:
                    $transaction->setDate( Carbon::parse( $line ) );
                    break;
                case DetailItems::T:
                case DetailItems::U:
                    $transaction->setAmount( (float) str_replace( ",", "", $line ) );
                    break;
                case DetailItems::M:
                    $transaction->setMemo( $line );
                    break;
                case DetailItems::C:
                    $transaction->setStatus( $line );
                    break;
                case DetailItems::P:
                    $transaction->setDescription( $line );
                    break;
                case DetailItems::A:
                    $transaction->setAddress( $line );
                    break;
                case DetailItems::O:
                    break;
                case DetailItems::L:
                    $transaction->setCategory( $line );
                    break;
                case "^":
                    $transaction->_raw = $transactionRaw;
                    $this->transactions[] = $transaction;
                    $transaction = new Transaction( $lastType );
                    $transactionRaw = "!Type:" . $lastType;
                    break;
            }

            $line = strtok( $this->separator );
        }
    }
}