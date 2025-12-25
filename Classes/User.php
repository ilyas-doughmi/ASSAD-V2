<?php 

Class User{
    protected $id;
    protected $full_name;
    protected $email;
    protected $password;
    protected $role;

    public function getId(): int
    {
        return $this->id;
    }

    public function getFullName(): string
    {
        return $this->full_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRole(): string{
        return $this->role;
    }

}