<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 10/27/2017
 * Time: 5:40 PM
 */

namespace Repo\Contracts;


interface SalesInterface
{
    public function index($keyword = null);

    public function getSales();

    public function saveSales($data);

    public function salesReturnStatus($id);
}