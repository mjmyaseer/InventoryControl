<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 9/2/2017
 * Time: 1:56 PM
 */

namespace Repo\Contracts;

interface CustomerInterface
{
    public function index();

    public function saveCustomer($request);
}