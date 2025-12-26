<?php

class tour
{
    protected $id;
    protected $title;
    protected $description;
    protected $date_heure_debut;
    protected $duree_minutes;
    protected $prix;
    protected $langue;
    protected $capacity_max;
    protected $status;
    protected $guide_id;
    protected $tour_image;

    protected $pdo;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    // getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDateHeureDebut(): string
    {
        return $this->date_heure_debut;
    }

    public function getDureeMinutes(): int
    {
        return $this->duree_minutes;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    public function getLangue(): string
    {
        return $this->langue;
    }

    public function getCapacityMax(): int
    {
        return $this->capacity_max;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getGuideId(): int
    {
        return $this->guide_id;
    }

    public function getTourImage(): string
    {
        return $this->tour_image;
    }

    //setters

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setDateHeureDebut(string $dateHeureDebut): void
    {
        $this->date_heure_debut = $dateHeureDebut;
    }

    public function setDureeMinutes(int $dureeMinutes): void
    {
        $this->duree_minutes = $dureeMinutes;
    }

    public function setPrix(float $prix): void
    {
        $this->prix = $prix;
    }

    public function setLangue(string $langue): void
    {
        $this->langue = $langue;
    }

    public function setCapacityMax(int $capacityMax): void
    {
        $this->capacity_max = $capacityMax;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setGuideId(int $guideId): void
    {
        $this->guide_id = $guideId;
    }

    public function setTourImage(string $tourImage): void
    {
        $this->tour_image = $tourImage;
    }

    // database methods 

    public function getToursByGuide(int $guide_id): array
    {
        $query = "SELECT * FROM tours WHERE guide_id = :guide_id ORDER BY date_heure_debut DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":guide_id", $guide_id);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getUpcomingTours(int $guide_id): array
    {
        $query = "SELECT * FROM tours WHERE guide_id = :guide_id AND date_heure_debut >= NOW() ORDER BY date_heure_debut ASC";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":guide_id", $guide_id);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function createTour()
    {
        $query = "INSERT INTO tours(titre,description,date_heure_debut,duree_minutes,prix,langue,capacity_max,guide_id,status,tour_image) 
                  VALUES(:titre, :description, :date_heure, :duree, :prix, :langue, :capacity, :guide_id, :status, :image)";

        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            ':titre' => $this->title,
            ':description' => $this->description,
            ':date_heure' => $this->date_heure_debut,
            ':duree' => $this->duree_minutes,
            ':prix' => $this->prix,
            ':langue' => $this->langue,
            ':capacity' => $this->capacity_max,
            ':guide_id' => $this->guide_id,
            ':status' => $this->status,
            ':image' => $this->tour_image
        ]);

        return $this->pdo->lastInsertId();
    }

    public function getAllTour()
    {
        $query = "SELECT * FROM tours WHERE status = 'open' AND date_heure_debut >= NOW() ORDER BY date_heure_debut ASC";
        $stmt = $this->pdo->connect()->query($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function cancelTour($id)
    {
        $query = "UPDATE tours SET status = 'cancelled' WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([':id' => $id]);
    }

    public function editTour(int $id): bool
    {
        $query = "UPDATE tours SET 
                    titre = :titre, 
                    description = :description, 
                    date_heure_debut = :date_heure, 
                    duree_minutes = :duree, 
                    prix = :prix, 
                    langue = :langue, 
                    capacity_max = :capacity, 
                    status = :status, 
                    tour_image = :image 
                  WHERE id = :id";
        
        $stmt = $this->pdo->prepare($query);
        
        return $stmt->execute([
            ':titre' => $this->title,
            ':description' => $this->description,
            ':date_heure' => $this->date_heure_debut,
            ':duree' => $this->duree_minutes,
            ':prix' => $this->prix,
            ':langue' => $this->langue,
            ':capacity' => $this->capacity_max,
            ':status' => $this->status,
            ':image' => $this->tour_image,
            ':id' => $id
        ]);
    }

    public function getTourById(int $id): ?array
    {
        $query = "SELECT * FROM tours WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $tour = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$tour) {
            return null;
        }
        
        $this->id = $tour['id'];
        $this->setTitle($tour['titre']);
        $this->setDescription($tour['description']);
        $this->setDateHeureDebut($tour['date_heure_debut']);
        $this->setDureeMinutes($tour['duree_minutes']);
        $this->setPrix($tour['prix']);
        $this->setLangue($tour['langue']);
        $this->setCapacityMax($tour['capacity_max']);
        $this->setStatus($tour['status']);
        $this->setGuideId($tour['guide_id']);
        $this->setTourImage($tour['tour_image']);
        
        return $tour;
    }

    public function getRemainingCapacity(int $tour_id): int
    {
        // Get total capacity
        $query1 = "SELECT capacity_max FROM tours WHERE id = :tour_id";
        $stmt1 = $this->pdo->prepare($query1);
        $stmt1->bindParam(':tour_id', $tour_id);
        $stmt1->execute();
        $result = $stmt1->fetch(PDO::FETCH_ASSOC);
        
        if (!$result) {
            return 0;
        }
        
        $capacity_max = $result['capacity_max'];
        
        // Get total reserved
        $query2 = "SELECT SUM(nb_personnes) as total_reserved FROM reservation WHERE tour_id = :tour_id";
        $stmt2 = $this->pdo->prepare($query2);
        $stmt2->bindParam(':tour_id', $tour_id);
        $stmt2->execute();
        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        
        $total_reserved = $result2['total_reserved'] ?? 0;
        
        return max(0, $capacity_max - $total_reserved);
    }

    public function getAllToursWithCapacity(): array
    {
        $query = "SELECT t.*, 
                  (t.capacity_max - COALESCE(SUM(r.nb_personnes), 0)) as remaining_capacity
                  FROM tours t
                  LEFT JOIN reservation r ON t.id = r.tour_id
                  WHERE t.status = 'open' AND t.date_heure_debut >= NOW()
                  GROUP BY t.id
                  ORDER BY t.date_heure_debut ASC";
        
        $stmt = $this->pdo->connect()->query($query);
        
        try {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}
