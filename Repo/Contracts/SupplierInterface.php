<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 9/2/2017
 * Time: 1:58 PM
 */

namespace Repo\Contracts;

interface SupplierInterface
{
    public function index($id = null);

    public function saveSupplier($id = null,$request);
}