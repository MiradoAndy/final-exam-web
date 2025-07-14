-- create database base;
-- use base;

CREATE TABLE membre (
    id_membre INT PRIMARY KEY auto_increment,
    nom VARCHAR(100),
    date_naissance DATE,
    genre VARCHAR(10),
    email VARCHAR(100),
    ville VARCHAR(100),
    mdp VARCHAR(100),
    image_profil VARCHAR(255)
);

CREATE TABLE categorie_objet (
    id_categorie INT PRIMARY KEY auto_increment,
    nom_categorie VARCHAR(100)
);

CREATE TABLE objet (
    id_objet INT PRIMARY KEY auto_increment,
    nom_objet VARCHAR(100),
    id_categorie INT,
    id_membre INT
);

CREATE TABLE images_objet (
    id_image INT PRIMARY KEY auto_increment,
    id_objet INT,
    nom_image VARCHAR(255)
);

CREATE TABLE emprunt (
    id_emprunt INT PRIMARY KEY auto_increment,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE,
    date_retour DATE
    );

-- Membres
INSERT INTO membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Alice', '1995-06-12', 'Femme', 'alice@email.com', 'Paris', 'mdp1', 'alice.jpg'),
('Bob', '1990-08-22', 'Homme', 'bob@email.com', 'Lyon', 'mdp2', 'bob.jpg'),
('Charlie', '1988-03-15', 'Homme', 'charlie@email.com', 'Nice', 'mdp3', 'charlie.jpg'),
('Mirado' , '2005-03-13', 'autre', 'mirado@gmail.com' , 'Antananarivo', '123', 'mirado.jpg');


-- Catégories
INSERT INTO categorie_objet (nom_categorie) VALUES
('esthetique'), ('bricolage'), ('mecanique'), ('cuisine');


-- Objets : 10 par membre = 40 objets
-- Pour simplifier : 1 = esthétique, 2 = bricolage, 3 = mécanique, 4 = cuisine

INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
-- Alice (id_membre = 1)
('Seche-cheveux', 1, 1), ('Marteau', 2, 1), ('Tournevis', 2, 1), ('Mixeur', 4, 1),
('Lisseur', 1, 1), ('Perceuse', 2, 1), ('Robot cuisine', 4, 1), ('Casserole', 4, 1),
('Cle anglaise', 3, 1), ('Rouleau peinture', 2, 1),

-- Bob (id_membre = 2)
('Tondeuse barbe', 1, 2), ('Visseuse', 2, 2), ('Pompe voiture', 3, 2), ('Four', 4, 2),
('Pince', 2, 2), ('Batteur', 4, 2), ('Micro-onde', 4, 2), ('Echelle', 2, 2),
('Casque soudure', 3, 2), ('Fer a lisser', 1, 2),

-- Charlie (id_membre = 3)
('Cle dynamometrique', 3, 3), ('Miroir maquillage', 1, 3), ('Perceuse colonne', 2, 3),
('Couteau chef', 4, 3), ('Pistolet peinture', 2, 3), ('Pied de biche', 2, 3),
('Mixeur plongeant', 4, 3), ('Rabot electrique', 2, 3), ('Ecrou geant', 3, 3), ('Brosse visage', 1, 3),

-- Diane (id_membre = 4)
('Fourchette electrique', 4, 4), ('Marteau piqueur', 2, 4), ('Cisaille', 2, 4),
('Cle a molette', 3, 4), ('Miroir LED', 1, 4), ('Robot patissier', 4, 4),
('Tournevis plat', 2, 4), ('Presse agrume', 4, 4), ('Pompe a air', 3, 4), ('Seche-main', 1, 4);


-- Images
INSERT INTO images_objet (id_objet, nom_image) VALUES
(1, 'seche.jpg'), (2, 'marteau.jpg'), (11, 'tondeuse.jpg'), (13, 'pompe.jpg'),
(21, 'cle_dyna.jpg'), (22, 'miroir.jpg'), (31, 'fourchette.jpg'), (32, 'piqueur.jpg'),
(39, 'pompe_air.jpg'), (40, 'seche_main.jpg');

-- Emprunts
INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2025-07-01', '2025-07-10'),
(5, 3, '2025-07-02', '2025-07-08'),
(14, 1, '2025-07-03', '2025-07-11'),
(21, 4, '2025-07-04', NULL),
(28, 2, '2025-07-05', NULL),
(33, 3, '2025-07-06', '2025-07-12'),
(6, 4, '2025-07-07', '2025-07-13'),
(18, 1, '2025-07-08', NULL),
(36, 2, '2025-07-09', NULL),
(30, 4, '2025-07-10', '2025-07-14');


