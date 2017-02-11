<?php
/**
 * Created by PhpStorm.
 * User: danilka
 * Date: 10.02.17
 * Time: 16:08
 */

namespace Storage;


use Entity\Chessboard;

interface IStorage
{
    public function prepare(Chessboard $chessboard);

    public function save();

    public function load();
}