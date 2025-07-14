create database base;
use base;

CREATE TABLE membre (
    id_membre INT PRIMARY KEY,
    nom VARCHAR(100),
    date_naissance DATE,
    genre VARCHAR(10),
    email VARCHAR(100),
    ville VARCHAR(100),
    mdp VARCHAR(100),
    image_profil VARCHAR(255)
);

CREATE TABLE categorie_objet (
    id_categorie INT PRIMARY KEY,
    nom_categorie VARCHAR(100)
);

CREATE TABLE objet (
    id_objet INT PRIMARY KEY,
    nom_objet VARCHAR(100),
    id_categorie INT,
    id_membre INT
);

CREATE TABLE images_objet (
    id_image INT PRIMARY KEY,
    id_objet INT,
    nom_image VARCHAR(255)
);

CREATE TABLE emprunt (
    id_emprunt INT PRIMARY KEY,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE,
    date_retour DATE
);

-- Membres
INSERT INTO membre VALUES
(1, 'Alice', '1995-06-12', 'F', 'alice@email.com', 'Paris', 'mdp1', 'alice.jpg'),
(2, 'Bob', '1990-08-22', 'M', 'bob@email.com', 'Lyon', 'mdp2', 'bob.jpg'),
(3, 'Charlie', '1988-03-15', 'M', 'charlie@email.com', 'Nice', 'mdp3', 'charlie.jpg'),
(4, 'Diane', '2000-12-01', 'F', 'diane@email.com', 'Toulouse', 'mdp4', 'diane.jpg');

-- Catégories
INSERT INTO categorie_objet VALUES
(1, 'esthétique'),
(2, 'bricolage'),
(3, 'mécanique'),
(4, 'cuisine');

-- Objets : 10 par membre = 40 objets
INSERT INTO objet VALUES
-- Alice
(1, 'Sèche-cheveux', 1, 1), (2, 'Marteau', 2, 1), (3, 'Tournevis', 2, 1), (4, 'Mixeur', 4, 1),
(5, 'Lisseur', 1, 1), (6, 'Perceuse', 2, 1), (7, 'Robot cuisine', 4, 1), (8, 'Casserole', 4, 1),
(9, 'Clé anglaise', 3, 1), (10, 'Rouleau peinture', 2, 1),

-- Bob
(11, 'Tondeuse barbe', 1, 2), (12, 'Visseuse', 2, 2), (13, 'Pompe voiture', 3, 2), (14, 'Four', 4, 2),
(15, 'Pince', 2, 2), (16, 'Batteur', 4, 2), (17, 'Micro-onde', 4, 2), (18, 'Échelle', 2, 2),
(19, 'Casque soudure', 3, 2), (20, 'Fer à lisser', 1, 2),

-- Charlie
(21, 'Clé dynamométrique', 3, 3), (22, 'Miroir maquillage', 1, 3), (23, 'Perceuse colonne', 2, 3),
(24, 'Couteau chef', 4, 3), (25, 'Pistolet peinture', 2, 3), (26, 'Pied de biche', 2, 3),
(27, 'Mixeur plongeant', 4, 3), (28, 'Rabot électrique', 2, 3), (29, 'Écrou géant', 3, 3), (30, 'Brosse visage', 1, 3),

-- Diane
(31, 'Fourchette électrique', 4, 4), (32, 'Marteau piqueur', 2, 4), (33, 'Cisaille', 2, 4),
(34, 'Clé à molette', 3, 4), (35, 'Miroir LED', 1, 4), (36, 'Robot pâtissier', 4, 4),
(37, 'Tournevis plat', 2, 4), (38, 'Presse agrume', 4, 4), (39, 'Pompe à air', 3, 4), (40, 'Sèche-main', 1, 4);

-- Images
INSERT INTO images_objet VALUES
(1, 1, 'seche.jpg'), (2, 11, 'tondeuse.jpg'), (3, 21, 'cle_dyna.jpg'), (4, 31, 'fourchette.jpg'),
(5, 2, 'marteau.jpg'), (6, 12, 'visseuse.jpg'), (7, 22, 'miroir.jpg'), (8, 32, 'piqueur.jpg'),
(9, 3, 'tournevis.jpg'), (10, 13, 'pompe.jpg');

-- Emprunts
INSERT INTO emprunt VALUES
(1, 1, 2, '2025-07-01', '2025-07-10'),
(2, 5, 3, '2025-07-02', '2025-07-08'),
(3, 14, 1, '2025-07-03', '2025-07-11'),
(4, 21, 4, '2025-07-04', NULL),
(5, 28, 2, '2025-07-05', NULL),
(6, 33, 3, '2025-07-06', '2025-07-12'),
(7, 6, 4, '2025-07-07', '2025-07-13'),
(8, 18, 1, '2025-07-08', NULL),
(9, 36, 2, '2025-07-09', NULL),
(10, 30, 4, '2025-07-10', '2025-07-14');

