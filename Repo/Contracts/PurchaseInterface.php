<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 10/24/2017
 * Time: 11:59 AM
 */

namespace Repo\Contracts;


interface PurchaseInterface
{
    public function index($keyword = null);

    public function getIndividualPurchase($id);

    public function savePurchases($data);

    public function purchaseReturnStatus($id);
}