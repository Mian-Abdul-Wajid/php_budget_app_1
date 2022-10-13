<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions Page</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th,
        table tr td {
            padding: 5px;
            border: 1px #eee solid;
        }

        tfoot tr th,
        tfoot tr td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Check #</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($transactions)) : ?>
                <?php foreach ($transactions as $transaction) : ?>
                    <tr>
                        <td><?= $transaction['date'] ?></td>
                        <td><?= $transaction['checkNo'] ?></td>
                        <td><?= $transaction['description'] ?></td>
                        <td>
                            <?php $formatAmt = formatDollarAmount($transaction['amount']) ?? 0 ?>
                            <?php if ($transaction['amount'] < 0) : ?>
                                <span style="color:red">
                                    <?= $formatAmt ?>
                                </span>
                            <?php elseif ($transaction['amount'] > 0) : ?>
                                <span style="color:green">
                                    <?= $formatAmt ?>
                                </span>
                            <?php else : ?>
                                <span>
                                    <?= $formatAmt ?>
                                </span>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Income:</th>
                <td>
                    <span style="color:green">
                        <?= formatDollarAmount($total['netIncome']) ?? 0 ?>
                    </span>
                </td>
            </tr>
            <tr>
                <th colspan="3">Total Expense:</th>
                <td>
                    <span style="color:red">
                        <?= formatDollarAmount($total['netExpense']) ?? 0   ?>
                    </span>
                </td>
            </tr>
            <tr>
                <th colspan="3">Net Total:</th>
                <td>
                    <?php $formatNetTotal = formatDollarAmount($total['netTotal']) ?? 0  ?>
                    <?php if ($transaction['amount'] < 0) : ?>
                        <span style="color:red">
                            <?= $formatNetTotal  ?>
                        </span>
                    <?php elseif ($transaction['amount'] > 0) : ?>
                        <span style="color:green">
                            <?= $formatNetTotal   ?>
                        </span>
                    <?php else : ?>
                        <span>
                            <?= $formatNetTotal   ?>
                        </span>
                    <?php endif ?>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>