<?php
namespace Models;
use think\Model;
class User extends Model
{
    protected $table = 'users';


    public function authenticate($password){
        if ($this->password != $this->encryptPassword($password) ) {
            return false;
        }
        return true;
    }

    public function encryptPassword($password){
        $defaultIterations = 10000;
        $defaultKeyLength = 64;
        $salt = base64_decode($this->salt);
        return base64_encode(hash_pbkdf2("sha1", $password, $salt, $defaultIterations, $defaultKeyLength));
    }

    public function setSaltAttr($value)
    {
        return base64_encode(openssl_random_pseudo_bytes($value));
    }

}