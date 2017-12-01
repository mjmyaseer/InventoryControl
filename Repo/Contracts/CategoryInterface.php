<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 9/2/2017
 * Time: 1:56 PM
 */

namespace Repo\Contracts;

interface CategoryInterface
{
    public function index($id = null);

    public function addCategory();

    public function saveCategory($id = null,$data);
}