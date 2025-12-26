<?php

class Habitat
{
    private $pdo;

    private int $id;
    private string $nom;
    private string $description;
    private string $image;
    private string $typeClimat;
    private string $zoneZoo;

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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getTypeClimat(): string
    {
        return $this->typeClimat;
    }

    public function getZoneZoo(): string
    {
        return $this->zoneZoo;
    }

    // setters

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function setTypeClimat(string $typeClimat): void
    {
        $this->typeClimat = $typeClimat;
    }

    public function setZoneZoo(string $zoneZoo): void
    {
        $this->zoneZoo = $zoneZoo;
    }

    // database methods

    public function getHabitatById(int $id): ?array
    {
        $query = "SELECT * FROM habitat WHERE id = :id";
        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $this->id = $data['id'];
        $this->setNom($data['nom']);
        $this->setDescription($data['description']);
        $this->setImage($data['image']);
        $this->setZoneZoo($data['zone']);
        $this->setTypeClimat($data['type_climat']);

        return $data;
    }

    public function getAllHabitat(): array
    {
        $query = "SELECT * FROM habitat";
        $stmt = $this->pdo->connect()->query($query);
        $habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'count' => count($habitats),
            'habitats' => $habitats
        ];
    }

    public function createHabitat(): bool
    {
        $query = "
            INSERT INTO habitat (nom, description, image, zone, type_climat)
            VALUES (:nom, :description, :image, :zone, :climat)
        ";

        $stmt = $this->pdo->connect()->prepare($query);

        return $stmt->execute([
            ':nom' => $this->nom,
            ':description' => $this->description,
            ':image' => $this->image,
            ':zone' => $this->zoneZoo,
            ':climat' => $this->typeClimat
        ]);
    }

    public function deleteHabitat($habitat_id): bool
    {
        $query = "DELETE FROM Habitat WHERE id = :habitat_id";
        $stmt = $this->pdo->connect()->prepare($query);

        return $stmt->execute([':habitat_id' => $habitat_id]);
    }

    public function editHabitat(int $id): bool
    {
        $query = "
            UPDATE habitat SET
                nom = :nom,
                description = :description,
                image = :image,
                zone = :zone,
                type_climat = :climat
            WHERE id = :id
        ";

        $stmt = $this->pdo->connect()->prepare($query);

        return $stmt->execute([
            ':nom' => $this->nom,
            ':description' => $this->description,
            ':image' => $this->image,
            ':zone' => $this->zoneZoo,
            ':climat' => $this->typeClimat,
            ':id' => $id
        ]);
    }
}
