<?php
/**
 * Created by PhpStorm.
 * User: danilka
 * Date: 10.02.17
 * Time: 16:24
 */

class Config
{
    const DB_HOST = 'localhost';
    const DB_USER = 'test';
    const DB_PASSWORD = '';
    const DB_NAME = 'chessboard';

    const SAVE_FILEPATH = './chessboard.txt';

    const REDIS_HOST = 'localhost';
    const REDIS_PORT = 6379;
    const REDIS_BOARD_KEY = 'chessboard';
}