<?php 

Class User{
    protected $id;
    protected $full_name;
    protected $email;
    protected $password;
    protected $role;
    protected $isActive;
    protected $isBanned;

    // getters

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
    
    public function getIsAtive(): string{
        return $this->isActive;
    }

    public function getIsBanned(): string{
        return $this->isBanned;
    }

    // setters

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setFullName(string $fullName): void
    {
        $this->full_name = $fullName;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = password_hash($password,PASSWORD_DEFAULT);
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function setIsActive(int $isActive): void
    {
        $this->isActive = $isActive;
    }

    public function setIsBanned(int $isBanned): void{
        $this->isBanned = $isBanned;
    }


}