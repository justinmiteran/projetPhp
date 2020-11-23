<?php
class Validation
{
    private $erreur;

    public function getErreur(){
        return $this->erreur;
    }

    public function email($email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->erreur[] = "email invalide : $email ";
            return false;
        }
        return true;
    }

    public function string($string){
        return $string = filter_var ($string, FILTER_SANITIZE_STRING);
    }
}