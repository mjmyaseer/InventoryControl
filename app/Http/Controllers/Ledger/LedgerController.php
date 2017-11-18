<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 11/13/2017
 * Time: 8:45 PM
 */

namespace App\Http\Controllers\Ledger;

use App\Http\Controllers\Controller;
use Repo\Contracts\LedgerInterface;

class LedgerController extends Controller
{
    private $ledger;

    public function __construct(LedgerInterface $ledger)
    {
        $this->ledger = $ledger;
    }

    /**
     * get the total stocks balance of all item
     * @return mixed
     */
    public function getTotalStockBalance()
    {
        $data = $this->ledger->getLedger();
//print_r($data[0]);exit();
        return view('ledger.index')->with('data', $data);
    }

    /**
     * @param $id
     * To find all credit and debit entries for a specific item
     * @return mixed
     */
    public function getIndividualItemEntries($id)
    {
        return $this->ledger->getIndividualItemEntries($id);
    }

}