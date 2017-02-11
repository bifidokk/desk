<?php
/**
 * Created by PhpStorm.
 * User: danilka
 * Date: 10.02.17
 * Time: 17:14
 */

namespace Storage;


class FileStorageManager implements IStorageManager
{
    public function __construct(){}

    public function getStorage()
    {
        return new FileStorage();
    }
}