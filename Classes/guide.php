<?php 

class guide extends User{
    protected $isActive;

    

    public function setIsActive(int $guide_id): string
    {
        $query = "UPDATE users SET isActive = 1 WHERE id = :guide_id";
        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(":guide_id",$guide_id);

        try{
             $stmt->execute();
             return "approved";
        }catch(PDOException $e){
            return $e->getMessage();
        }
       
    }

    public function getGuides()
    {
        $query = "SELECT * FROM users WHERE role = 'guide' AND isActive = 0";
        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->execute();
        $guides = $stmt->fetchAll();
        $count = count($guides);

        return [
            'count' => $count,
            'users' => $guides
        ];
    }


}