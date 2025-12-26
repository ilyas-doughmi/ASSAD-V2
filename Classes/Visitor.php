<?php

class visitor extends User{
    protected $isBanned;


    public function banAccount(int $user_id): void
    {
        $query = "UPDATE users SET isBanned = 1 , isActive = 1 WHERE id = :user_id";
        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
    }

    public function unBanAccount(int $user_id): void
    {
        $query = "UPDATE users SET isBanned = 0 , isActive = 1 WHERE id = :user_id";
        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
    }


}