<?php
/**
 * Created by PhpStorm.
 * User: danilka
 * Date: 10.02.17
 * Time: 15:46
 */

namespace Entity;


class ChessPiece
{
    /**
     * @var int
     */
    private $type;

    private $xcoord;

    private $ycoord;

    /**
     * @param int $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getXcoord()
    {
        return $this->xcoord;
    }

    /**
     * @param int $xcoord
     */
    public function setXcoord($xcoord)
    {
        $this->xcoord = $xcoord;
    }

    /**
     * @return int
     */
    public function getYcoord()
    {
        return $this->ycoord;
    }

    /**
     * @param int$ycoord
     */
    public function setYcoord($ycoord)
    {
        $this->ycoord = $ycoord;
    }


}