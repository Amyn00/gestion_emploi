CREATE DATABASE gestion_emploi;
USE gestion_emploi;

-- Table des professeurs
CREATE TABLE professeurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150)  NOT NULL,
    telephone VARCHAR(20)
);

-- Table de Departement
CREATE TABLE departement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

-- Table des Filiere
CREATE TABLE filiere (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    departement_id INT,
    FOREIGN KEY (departement_id) REFERENCES departement(id) ON DELETE SET NULL
);

-- Table des modules
CREATE TABLE modules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    code VARCHAR(50) UNIQUE NOT NULL
);

-- Table des éléments (liés aux modules)
CREATE TABLE elements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    module_id INT,
    FOREIGN KEY (module_id) REFERENCES modules(id) ON DELETE CASCADE
);

-- Table des salles avec équipements
CREATE TABLE salles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    capacite INT NOT NULL
);

-- Table des équipements
CREATE TABLE equipements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

-- Relation salle-équipement (une salle peut avoir plusieurs équipements)
CREATE TABLE salle_equipements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    salle_id INT,
    equipement_id INT,
    quantite INT NOT NULL DEFAULT 1,
    FOREIGN KEY (salle_id) REFERENCES salles(id) ON DELETE CASCADE,
    FOREIGN KEY (equipement_id) REFERENCES equipements(id) ON DELETE CASCADE
);

-- Table des créneaux horaires
CREATE TABLE creneaux (
    id INT AUTO_INCREMENT PRIMARY KEY,
    heure_debut TIME NOT NULL,
    heure_fin TIME NOT NULL
);

-- Table des semaines (stocke "semaine 1" à "semaine 20")
CREATE TABLE semaines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    semaine INT
);

-- Table des emplois du temps
CREATE TABLE emplois_du_temps (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prof_id INT,
    element_id INT,
    salle_id INT,
    jour ENUM('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi') NOT NULL,
    semaine_debut_id INT,
    semaine_fin_id INT,
    creneau_id INT,
    FOREIGN KEY (prof_id) REFERENCES professeurs(id) ON DELETE CASCADE,
    FOREIGN KEY (element_id) REFERENCES elements(id) ON DELETE CASCADE,
    FOREIGN KEY (salle_id) REFERENCES salles(id) ON DELETE CASCADE,
    FOREIGN KEY (semaine_debut_id) REFERENCES semaines(id) ON DELETE CASCADE,
    FOREIGN KEY (semaine_fin_id) REFERENCES semaines(id) ON DELETE CASCADE,
    FOREIGN KEY (creneau_id) REFERENCES creneaux(id) ON DELETE CASCADE
);

-- Insertion des créneaux horaires
INSERT INTO creneaux (heure_debut, heure_fin) VALUES 
('08:30:00', '10:30:00'),
('10:30:00', '12:30:00'),
('14:30:00', '16:30:00'),
('16:30:00', '18:30:00');

-- Insertion des semaines ("semaine1" à "semaine13")
INSERT INTO semaines (semaine) VALUES
('1'), ('2'), ('3'), ('4'), ('5'), 
('6'), ('7'), ('8'), ('9'), ('10'), 
('11'), ('12'), ('13'), ('14'), ('15'),
('16'), ('17'), ('18'), ('19'), ('20');

ALTER TABLE modules ADD COLUMN filiere_id INT;
ALTER TABLE modules ADD FOREIGN KEY (filiere_id) REFERENCES filiere(id) ON DELETE SET NULL;

ALTER TABLE emplois_du_temps ADD COLUMN module_id INT;
ALTER TABLE emplois_du_temps ADD FOREIGN KEY (module_id) REFERENCES module(id) ON DELETE CASCADE;

ALTER TABLE emplois_du_temps ADD COLUMN filiere_id INT;
ALTER TABLE emplois_du_temps ADD FOREIGN KEY (filiere_id) REFERENCES filiere(id) ON DELETE CASCADE;