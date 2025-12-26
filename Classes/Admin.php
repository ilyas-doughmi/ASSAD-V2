<?php

Class Admin extends User{

    public function getMostReservedTours(int $limit = 5): array
    {
        $query = "SELECT t.*, COUNT(r.id) as reservation_count 
                  FROM tours t 
                  LEFT JOIN reservation r ON t.id = r.tour_id 
                  GROUP BY t.id 
                  ORDER BY reservation_count DESC 
                  LIMIT :limit";
        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVisitorsByCountry(): array
    {
        $query = "SELECT pays_origin as country, COUNT(*) as count 
                  FROM animal 
                  GROUP BY pays_origin 
                  ORDER BY count DESC";
        $stmt = $this->pdo->connect()->query($query);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalVisitors(): int
    {
        $query = "SELECT COUNT(*) as count FROM users WHERE role = 'visitor'";
        $stmt = $this->pdo->connect()->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'];
    }

    public function getTotalAnimals(): int
    {
        $query = "SELECT COUNT(*) as count FROM animal";
        $stmt = $this->pdo->connect()->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'];
    }

    public function getTotalRevenue(): float
    {
        $query = "SELECT SUM(t.prix * r.nb_personnes) as total 
                  FROM reservation r 
                  JOIN tours t ON r.tour_id = t.id";
        $stmt = $this->pdo->connect()->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'] ?? 0;
    }
}