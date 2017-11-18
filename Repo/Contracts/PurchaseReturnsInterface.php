<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 11/14/2017
 * Time: 11:21 PM
 */

namespace Repo\Contracts;


interface PurchaseReturnsInterface
{
    public function index();

    public function getPurchaseReturns($id = null,$keyword = null);

    public function savePurchaseReturn($data);
}