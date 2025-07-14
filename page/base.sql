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

-insertion de donnée lors dde l inscription :
insert into