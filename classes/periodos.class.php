<?php
class Periodos {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getPeriodos() {
        $array = array();

        $sql = "SELECT * FROM periodos";
        $sql = $this->pdo->query($sql);

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }
}