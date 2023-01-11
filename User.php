<?php

class User
{
    const EMAIL = 'sonja@email.com';
    const PASSWORD = 'sonja123';

    private $email = '';
    private $password = '';
    public $errors = [];

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    private function validateEmail(){
        if(strlen($this->email)==0){
            $this->errors['email'] = 'Email darf nicht leer sein';
            return false;
        }
        else if(strlen($this->email)>30){
        $this->errors['email'] = 'Email darf nicht länger als 30 Zeichen sein. Bitte geben Sie ein Email mit weniger als 30 Zeichen ein';
        return false;
        }
        else if(strlen($this->email)<5){
            $this->errors['email'] = 'Email darf nicht kürzer als 5 Zeichen sein. Bitte geben Sie ein Email mit mehr als 5 Zeichen ein';
            return false;
        }
        else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->errors['email'] = 'Invalid email format!';
            return false;
        }
        else
            return true;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    private function validatePassword(){
        if(strlen($this->password)==0){
            $this->errors['password'] = 'Passwort darf nicht leer sein';
            return false;
        }
        else if(strlen($this->password)>20){
            $this->errors['password'] = 'Passwort darf nicht länger als 20 Zeichen sein. Bitte geben Sie ein Passwort mit weniger als 30 Zeichen ein';
            return false;
        }
        else if(strlen($this->password)<5){
            $this->errors['password'] = 'Passwort darf nicht kürzer als 5 Zeichen sein. Bitte geben Sie ein Passwort mit mehr als 5 Zeichen ein';
            return false;
        }
        else
            return true;
    }

    public function validate(){
        return $this->validateEmail() && $this->validatePassword();
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function hasErrors($field)
    {
        return isset($this->errors[$field]);
    }

    /**
     * @return bool|void
     */

    public function login(){
        if ($this->validate() && $this->email == self::EMAIL && $this->password == self::PASSWORD){
            $_SESSION['email']= $this->getEmail();
            return true;
        }
        else{
            $this->errors['credentials'] = "Zugangsdaten ungultig!";
            unset($_SESSION['email']);
            return false;
        }
    }

    public function logout(){
        unset($_SESSION ['email']);
        //session_destroy();
    }

    public static function isLoggedIn(){
        if(isset($_SESSION['email']) && strlen($_SESSION['email']>0) && $_SESSION['email'] == self::EMAIL ){
            return true;
        }
        return false;
    }

}