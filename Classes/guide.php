<?php

class guide extends User
{
    protected $isActive;


    public function getIsActive()
    {
        return $this->isActive;
    }



    public function setIsActive(int $guide_id): string
    {
        if ($this->isActive == false) {
            $query = "UPDATE users SET isActive = 1 WHERE id = :guide_id";
            $stmt = $this->pdo->connect()->prepare($query);
            $stmt->bindParam(":guide_id", $guide_id);

            try {
                $stmt->execute();
                $this->isActive = true;
                return "approved";
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }
        else
        {
            return "already activated";
        }
    }

    public function rejectGuide(int $guide_id): void
    {
        $query = "UPDATE users SET isBanned = 1 , isActive = 1 WHERE id = :guide_id";
        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(":guide_id", $guide_id);
        $stmt->execute();
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

    public function getGuideStats(int $guide_id): array
    {
        $pdo = $this->pdo->connect();

        $query1 = "SELECT COUNT(*) as count FROM tours WHERE guide_id = :guide_id AND MONTH(date_heure_debut) = MONTH(CURRENT_DATE())";
        $stmt1 = $pdo->prepare($query1);
        $stmt1->bindParam(":guide_id", $guide_id);
        $stmt1->execute();
        $res1 = $stmt1->fetch(PDO::FETCH_ASSOC);

        $query2 = "SELECT COUNT(*) as count FROM reservation r JOIN tours t ON r.tour_id = t.id WHERE t.guide_id = :guide_id";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->bindParam(":guide_id", $guide_id);
        $stmt2->execute();
        $res2 = $stmt2->fetch(PDO::FETCH_ASSOC);

        $query3 = "SELECT AVG(note) as avg FROM comments c JOIN tours t ON c.tour_id = t.id WHERE t.guide_id = :guide_id";
        $stmt3 = $pdo->prepare($query3);
        $stmt3->bindParam(":guide_id", $guide_id);
        $stmt3->execute();
        $res3 = $stmt3->fetch(PDO::FETCH_ASSOC);

        return [
            "tours_month" => $res1['count'],
            "visitors" => $res2['count'],
            "rating" => $res3['avg'] ? round($res3['avg'], 1) : "N/A"
        ];
    }

    public function getGuideBookings(int $guide_id): array
    {
        $query = "SELECT r.id as res_id, r.nb_personnes, u.full_name, t.titre, t.date_heure_debut, t.prix, r.date_reservation 
                  FROM reservation r 
                  JOIN users u ON r.user_id = u.id 
                  JOIN tours t ON r.tour_id = t.id 
                  WHERE t.guide_id = :guide_id 
                  ORDER BY r.date_reservation DESC";
        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(":guide_id", $guide_id);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}
