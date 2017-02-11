<?php
/**
 * Created by PhpStorm.
 * User: danilka
 * Date: 11.02.17
 * Time: 13:52
 */

namespace Service;


use Event\AddChessPieceEvent;

class SomeService
{
    public function printChessPieceAdded(AddChessPieceEvent $event)
    {
        if($event->getChessPiece()->getType() == 1) {
            print "Pawn added!\n";
        }

        print "Chess piece added!\n";
    }
}