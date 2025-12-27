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

    public function setId(int $id): void
    {
        $this->id = $id;
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

    public function getAllTours()
    {
        $query = "SELECT * FROM tours ORDER BY date_heure_debut DESC";
        $stmt = $this->pdo->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function cancelTour($id)
    {
        $query = "UPDATE tours SET status = 'cancelled' WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([':id' => $id]);
    }

    public function editTour(): bool
    {
        $query = "UPDATE tours SET 
                  titre = :titre, 
                  description = :description, 
                  date_heure_debut = :date_heure, 
                  duree_minutes = :duree, 
                  prix = :prix, 
                  langue = :langue, 
                  capacity_max = :capacity, 
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
            ':image' => $this->tour_image,
            ':id' => $this->id
        ]);
    }

    public function getTotalRevenue()
    {
        $query = "SELECT SUM(prix) as total FROM tours";
        $stmt = $this->pdo->connect()->query($query);
        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function getTourById(int $id)
    {
        $query = "SELECT * FROM tours WHERE id = :id";
        $stmt = $this->pdo->connect()->prepare($query); 
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
