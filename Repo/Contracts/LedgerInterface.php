<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 11/7/2017
 * Time: 9:36 PM
 */

namespace Repo\Contracts;


interface LedgerInterface
{
    public function getLedger();

    public function saveLedgerSales($data, $request);

    public function saveLedgerPurchases($data,$request);

    public function getQuantityBalance($id);
}