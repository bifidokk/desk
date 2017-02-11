<?php
/**
 * Created by PhpStorm.
 * User: danilka
 * Date: 10.02.17
 * Time: 17:33
 */

namespace Storage;


class RedisStorageManager implements IStorageManager
{
    public function __construct(){}

    public function getStorage()
    {
        return new RedisStorage();
    }
}