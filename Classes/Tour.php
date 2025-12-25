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
}
