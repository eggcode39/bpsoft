<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 05/11/2018
 * Time: 9:29
 */

class Sell{
    private $pdo;
    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }
}