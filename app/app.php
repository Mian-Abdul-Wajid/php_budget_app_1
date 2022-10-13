<?php

declare(strict_types=1);
// Your Code here - Main logic & functions

function getTransactionFiles(string $dirName): array
{

    $files = [];

    foreach (scandir($dirName) as $file) {

        if (is_dir($file)) {
            continue;
        } else {

            $files[] = $dirName . $file;
            // echo '<pre>';
            // var_dump($file);
        }
    }
    return $files;
}


function getTransactions(string $fileName, ?callable $transactionsHandler = null): array
{
    if (!file_exists($fileName)) {
        trigger_error("$fileName: File Not found", E_USER_ERROR);
    }
    $transactions = [];

    $file = fopen($fileName, 'r');

    fgetcsv($file);

    while (($transaction = fgetcsv($file)) !== false) {
        // flexibility use callable function for parsingtransaction function, if files data in different format.
        if ($transactionsHandler !== null) {
            $transaction = $transactionsHandler($transaction);
        }

        $transactions[] = $transaction;
    }
    return $transactions;
}



function parseTransactionsFromTransFiles(array $trans): array
{

    [$date, $checkNo, $description, $amount] = $trans;

    $amount = (float) str_replace(['$', ','], '', $amount);

    return [
        'date' => $date,
        'checkNo' => $checkNo,
        'description' => $description,
        'amount' => $amount
    ];
}

function parseTransactionsFromBankA(array $trans): array
{

    [$amount, $date, $checkNo, $description] = $trans;

    $amount = str_replace(['$', ','], '', $amount);

    return [
        'amount' => $amount,
        'date' => $date,
        'checkNo' => $checkNo,
        'description' => $description
    ];
}

function calculateTotals(array $trans): array
{
    $totals = ['netIncome' => 0, 'netExpense' => 0, 'netTotal' => 0];

    foreach ($trans as $tran) {

        $totals['netTotal'] += $tran['amount'];

        if ($tran['amount'] >= 0) {
            $totals['netIncome'] += $tran['amount'];
        } else {
            $totals['netExpense'] += $tran['amount'];
        }
    }
    return $totals;
}
