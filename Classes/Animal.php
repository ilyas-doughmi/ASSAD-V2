<?php

class Animal
{
    private $pdo;

    private int $id;
    private string $nom;
    private string $espece;
    private string $image;
    private string $description;
    private string $alimentation;
    private string $paysOrigin;
    private int $habitatId;
    private int $vues;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getEspece(): string
    {
        return $this->espece;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAlimentation(): string
    {
        return $this->alimentation;
    }

    public function getPaysOrigin(): string
    {
        return $this->paysOrigin;
    }

    public function getHabitatId(): int
    {
        return $this->habitatId;
    }

    public function getVues(): int
    {
        return $this->vues;
    }

    // setters

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function setEspece(string $espece): void
    {
        $this->espece = $espece;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setAlimentation(string $alimentation): void
    {
        $this->alimentation = $alimentation;
    }

    public function setPaysOrigin(string $paysOrigin): void
    {
        $this->paysOrigin = $paysOrigin;
    }

    public function setHabitatId(int $habitatId): void
    {
        $this->habitatId = $habitatId;
    }

    public function setVues(int $vues): void
    {
        if ($vues >= 0) {
            $this->vues = $vues;
        }
    }

    // database methodes

    public function getAnimalById(int $id): ?array
    {
        $query = "SELECT * FROM animal WHERE id = :id";
        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $animal = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$animal) {
            return null;
        }

        $this->id = $animal['id'];
        $this->setNom($animal['nom']);
        $this->setEspece($animal['espece']);
        $this->setPaysOrigin($animal['pays_origin']);
        $this->setHabitatId($animal['habitat_id']);
        $this->setDescription($animal['description_courte']);
        $this->setAlimentation($animal['alimentation']);
        $this->setImage($animal['image']);
        $this->setVues($animal['vues']);

        return $animal;
    }

    public function getAllAnimals(): array
    {
        $query = "SELECT * FROM animal";
        $stmt = $this->pdo->connect()->query($query);
        $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'count' => count($animals),
            'animals' => $animals
        ];
    }

    public function createAnimal(): bool
    {
        $query = "
            INSERT INTO animal 
            (nom, espece, pays_origin, habitat_id, description_courte, alimentation, image, vues)
            VALUES 
            (:nom, :espece, :pays, :habitat, :description, :alimentation, :image, 0)
        ";

        $stmt = $this->pdo->connect()->prepare($query);

        return $stmt->execute([
            ':nom' => $this->nom,
            ':espece' => $this->espece,
            ':pays' => $this->paysOrigin,
            ':habitat' => $this->habitatId,
            ':description' => $this->description,
            ':alimentation' => $this->alimentation,
            ':image' => $this->image
        ]);
    }

    public function editAnimal(int $id): bool
    {
        $query = "
            UPDATE animal SET
                nom = :nom,
                espece = :espece,
                pays_origin = :pays,
                habitat_id = :habitat,
                description_courte = :description,
                alimentation = :alimentation,
                image = :image
            WHERE id = :id
        ";

        $stmt = $this->pdo->connect()->prepare($query);

        return $stmt->execute([
            ':nom' => $this->nom,
            ':espece' => $this->espece,
            ':pays' => $this->paysOrigin,
            ':habitat' => $this->habitatId,
            ':description' => $this->description,
            ':alimentation' => $this->alimentation,
            ':image' => $this->image,
            ':id' => $id
        ]);
    }

    public function deleteAnimal(int $id): bool
    {
        $query = "DELETE FROM animal WHERE id = :id";
        $stmt = $this->pdo->connect()->prepare($query);

        return $stmt->execute([':id' => $id]);
    }
}
