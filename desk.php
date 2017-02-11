<?php
/**
 * Created by PhpStorm.
 * User: danilka
 * Date: 10.02.17
 * Time: 15:56
 */
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

$someService = new \Service\SomeService();

$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
$dispatcher->addListener(\Event\ChessBoardEvents::CHESS_PIECE_ADDED, array($someService, 'printChessPieceAdded'));

$chessBoardFactory = new \Factory\ChessboardFactory($dispatcher);
$chessBoard =  $chessBoardFactory->createChessboard(8, 8);

$chessPiece = new \Entity\ChessPiece(3);
$chessBoard->addChesspiece($chessPiece, 0, 0);

/**
 * Посчитал, что нехорошо отправлять $dispatcher в entity доски и там создавать событие.
 * В любом случае созданием у нас может заниматься какой-то контроллер, либо всё можно возложить на фабрику.
 */
$dispatcher->dispatch(\Event\ChessBoardEvents::CHESS_PIECE_ADDED, new \Event\AddChessPieceEvent($chessPiece));

$chessBoard->moveChesspiece($chessPiece, 1, 0);

$manager = new \Storage\RedisStorageManager();
$storage = $manager->getStorage();

$storage->prepare($chessBoard)->save();

$chessBoardFields = $storage->load();
$chessBoard = $chessBoardFactory->createChessboard(8, 8, $chessBoardFields);