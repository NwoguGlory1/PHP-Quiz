<?php
// namespace House;

class House {
    public $streetName;
    public $streetNr;

    public function __construct ($streetName, $streetNr) {
        $this->streetName = $streetName;
        $this->streetNr = $streetNr;
    }

    public function getAddress() {
        $house = $this->streetName . " " . $this->streetNr . " years old";
        return $house; 
    }
}