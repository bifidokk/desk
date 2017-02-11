<?php
/**
 * Created by PhpStorm.
 * User: danilka
 * Date: 10.02.17
 * Time: 16:09
 */

namespace Storage;


class DbStorageManager implements IStorageManager
{
    public function __construct(){}

    public function getStorage()
    {
        return new DbStorage();
    }
}