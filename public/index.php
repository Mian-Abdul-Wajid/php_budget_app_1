<?php


declare(strict_types=1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;


define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR );
define('T_FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR );
define('BANKA_PATH', $root . 'banka_files' . DIRECTORY_SEPARATOR );
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR );

// echo '<pre>';
// print_r(BANKA_PATH);
// die;

require_once APP_PATH . 'app.php';
require_once APP_PATH . 'helper.php';


$files = getTransactionFiles(T_FILES_PATH);

$transactions = [];

foreach ($files as $file){
$transactions = array_merge($transactions, getTransactions($file, 'parseTransactionsFromTransFiles'));
}

$files_1 = getTransactionFiles(BANKA_PATH);

foreach ($files_1 as $file){
$transactions = array_merge($transactions, getTransactions($file, 'parseTransactionsFromBankA'));
}

$total = calculateTotals($transactions);

require_once VIEWS_PATH . 'transactions.php';

// echo '<pre>';
// var_dump($total);
// die;

// print_r(VIEWS_PATH);