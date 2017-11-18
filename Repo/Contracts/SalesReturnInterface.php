<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 11/17/2017
 * Time: 1:12 AM
 */

namespace Repo\Contracts;


interface SalesReturnInterface
{
    public function index();

    public function getSalesReturns($id = null, $keyword = null);

    public function saveSalesReturn($data);
}