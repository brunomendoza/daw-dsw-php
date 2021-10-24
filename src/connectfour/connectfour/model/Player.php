<?php

namespace connectfour\model;

class Player {
    private string firstName;
    private string lastName;
    private string address;
    private string province;
    private string country;
    private string age;
    private string color;

    public function __construct(string firstName, string lastName) {
        $this->firstName = firstName;
        $this->lastName = lastName;
    }

    public string getFirstName() {
        return $this->firstName;
    }

    public Player setFirstName(string firstName) {
        $this->firstName = $firstName;
        return $this;
    }
}