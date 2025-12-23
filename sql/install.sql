CREATE DATABASE ASSAD;
USE ASSAD;

CREATE TABLE Habitat (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    image VARCHAR(255)
);

CREATE TABLE Animal (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    espece VARCHAR(255),
    pays_origin VARCHAR(255),
    image VARCHAR(255),
    description_courte TEXT,
    alimentation VARCHAR(255),
    habitat_id INT,

    FOREIGN KEY (habitat_id) REFERENCES Habitat(id)
        ON DELETE SET NULL
);

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50),
    isBanned BOOLEAN DEFAULT FALSE,
    isActive BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Tours (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    date_heure_debut DATETIME,
    duree_minutes INT,
    prix DECIMAL(8,2),
    langue VARCHAR(255),
    capacity_max INT,
    status VARCHAR(100),
    guide_id INT,
    tour_image VARCHAR(255),

    FOREIGN KEY (guide_id) REFERENCES users(id)
        ON DELETE SET NULL
);

CREATE TABLE tour_step (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre_etape VARCHAR(150),
    description_etape TEXT,
    order_etape INT,
    tour_id INT,

    FOREIGN KEY (tour_id) REFERENCES Tours(id)
        ON DELETE CASCADE
);

CREATE TABLE Reservation (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    tour_id INT,
    date_reservation DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE,
    FOREIGN KEY (tour_id) REFERENCES Tours(id)
        ON DELETE CASCADE
);

CREATE TABLE Comments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    tour_id INT,
    note INT CHECK (note BETWEEN 1 AND 5),
    texte TEXT,
    date_commentaire DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE,
    FOREIGN KEY (tour_id) REFERENCES Tours(id)
        ON DELETE CASCADE
);


-- adding admin (password is admin123)

INSERT INTO users(full_name,email,password,role,isActive) VALUES("Ilyas Doughmi","admin@gmail.com","$2y$10$bSuhIS36G5C7c2NuqTXUmu3aBMLh5LYQXjmmAdQQas3aL8puDy7XW","admin",1);

-- inserting habitat
INSERT INTO Habitat (nom, description, image) VALUES
(
    'Savane',
    'Vaste plaine africaine caractérisée par une végétation herbacée et quelques arbres. Habitat naturel des lions, girafes et éléphants.',
    'savane.jpg'
),
(
    'Forêt tropicale',
    'Milieu chaud et humide avec une biodiversité exceptionnelle. Abrite de nombreuses espèces d’oiseaux, de reptiles et de mammifères.',
    'foret_tropicale.jpg'
),
(
    'Désert',
    'Zone aride avec de faibles précipitations et des températures extrêmes. Adapté aux espèces résistantes comme les dromadaires et les fennecs.',
    'desert.jpg'
),
(
    'Zone polaire',
    'Région glaciale aux températures très basses. Habitat des ours polaires, manchots et phoques.',
    'zone_polaire.jpg'
),
(
    'Jungle',
    'Forêt dense et humide avec une végétation luxuriante. Accueille des tigres, singes et serpents.',
    'jungle.jpg'
);


-- inserting habitat

INSERT INTO Habitat (nom, description, image) VALUES
('Savane', 'Vastes plaines herbeuses, domaine des grands prédateurs.', 'savane.jpg'),
('Forêt tropicale', 'Végétation dense et humide, riche en biodiversité.', 'foret_tropicale.jpg'),
('Désert', 'Environnement aride aux températures extrêmes.', 'desert.jpg'),
('Zone polaire', 'Terres de glace et de froid intense.', 'zone_polaire.jpg'),
('Jungle', 'Forêt impénétrable abritant des espèces mystérieuses.', 'jungle.jpg'),
('Rivière', 'Cours d eau douce et zones humides.', 'riviere.jpg');

-- insert animals
INSERT INTO Animal (nom, espece, pays_origin, habitat_id, image, description_courte, alimentation) VALUES
-- Savane (ID: 1)
('Asaad', 'Panthera leo leo', 'Maroc', 1, 'https://images.unsplash.com/photo-1614027164847-1b28cfe1df60', 'Le majestueux Lion de l\'Atlas, symbole de force et de noblesse.', 'Carnivore'),
('Kian', 'Loxodonta africana', 'Tanzanie', 1, 'https://images.unsplash.com/photo-1557050543-4d5f4e07ef46', 'Le plus grand mammifère terrestre, connu pour sa sagesse.', 'Herbivore'),
('Zola', 'Giraffa camelopardalis', 'Afrique du Sud', 1, 'https://images.unsplash.com/photo-1541789094913-f3809a8f3ba5', 'Une élégance naturelle qui domine la savane de toute sa hauteur.', 'Herbivore'),

-- Jungle (ID: 5)
('Kong', 'Gorilla beringei', 'Congo', 5, 'https://images.unsplash.com/photo-1535940587886-905c8680c656', 'Un colosse au dos argenté, protecteur de son clan.', 'Omnivore'),
('Rio', 'Ara macao', 'Brésil', 5, 'https://images.unsplash.com/photo-1552728089-57bdde30beb8', 'Un tourbillon de couleurs volant à travers la canopée.', 'Frugivore'),

-- Désert (ID: 3)
('Sahara', 'Vulpes zerda', 'Maroc', 3, 'https://images.unsplash.com/photo-1570347854605-6a585e509c8e', 'Le fennec, petit renard des sables aux grandes oreilles.', 'Omnivore'),
('Dromadaire', 'Camelus dromedarius', 'Maroc', 3, 'https://images.unsplash.com/photo-1598454443452-98aa42db260e', 'Le vaisseau du désert, infatigable voyageur.', 'Herbivore'),

-- Rivière (ID: 6)
('Sobek', 'Crocodylus niloticus', 'Égypte', 6, 'https://images.unsplash.com/photo-1516021677334-93c0490f2378', 'Le redoutable gardien des eaux du Nil.', 'Carnivore');


