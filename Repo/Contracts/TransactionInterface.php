<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 11/14/2017
 * Time: 7:26 PM
 */

namespace Repo\Contracts;


interface TransactionInterface
{
    public function index($id = null);

    public function saveTransactions($data,$request);
}