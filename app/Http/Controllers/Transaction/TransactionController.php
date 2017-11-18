<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 11/14/2017
 * Time: 8:03 PM
 */

namespace App\Http\Controllers\Transaction;
use App\Http\Controllers\Controller;
use Repo\Contracts\TransactionInterface;

class TransactionController extends Controller
{

    private $transaction;

    public function __construct(TransactionInterface $transaction)
    {
        $this->transaction = $transaction;
    }

    public function getTransactions($id = null)
    {
        $transaction = $this->transaction->index($id);

        return view('Transaction.index')->with('data', $transaction);
    }
}