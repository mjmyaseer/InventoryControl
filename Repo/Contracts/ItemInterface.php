<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 9/2/2017
 * Time: 1:57 PM
 */

namespace Repo\Contracts;

interface ItemInterface
{
    public function index($id = null);

    public function viewItem($id);

    public function saveItem($id = null,$request);

    public function inactiveItem();
}