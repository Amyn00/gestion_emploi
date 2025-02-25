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
    nom VARCHAR(255) NOT NULL,
    abrv VARCHAR(7) NOT NULL,
    prof_id INT,
    FOREIGN KEY (prof_id) REFERENCES professeurs(id) ON DELETE SET NULL
);

-- Table des Filiere
CREATE TABLE filiere (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    abrv VARCHAR(7) NOT NULL,
    departement_id INT,
    FOREIGN KEY (departement_id) REFERENCES departement(id) ON DELETE SET NULL
);

-- Table des modules
CREATE TABLE modules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    code VARCHAR(50) UNIQUE NOT NULL,
    filiere_id INT,
    FOREIGN KEY (filiere_id) REFERENCES filiere(id) ON DELETE SET NULL
);

-- Table des éléments (liés aux modules)
CREATE TABLE elements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    module_id INT,
    FOREIGN KEY (module_id) REFERENCES modules(id) ON DELETE CASCADE
);

-- Table des groupe repartie pour Les TPs et TD
CREATE TABLE groupes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(150) NOT NULL
);

-- Table des salles avec équipements
CREATE TABLE salles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    capacite INT NOT NULL,
    nb_exam INT NOT NULL
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
    FOREIGN KEY (salle_id) REFERENCES salles(id) ON DELETE CASCADE,
    FOREIGN KEY (equipement_id) REFERENCES equipements(id) ON DELETE CASCADE
);

-- Table des créneaux horaires
CREATE TABLE creneaux (
    id INT AUTO_INCREMENT PRIMARY KEY,
    heure_debut TIME NOT NULL,
    heure_fin TIME NOT NULL,
    CHECK (heure_debut < heure_fin)
);

-- Table des semaines (stocke "semaine 1" à "semaine 20")
CREATE TABLE semaines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    semaine INT NOT NULL UNIQUE
);

-- Table des emplois du temps
CREATE TABLE emplois_du_temps (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prof_id INT,
    module_id INT,
    element_id INT,
    filiere_id INT,
    salle_id INT,
    jour ENUM('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi') NOT NULL,
    nature ENUM('Cours','TD','TP') NOT NULL,
    semaine_debut_id INT,
    semaine_fin_id INT,
    creneau_id INT,
    group_id INT,
    FOREIGN KEY (prof_id) REFERENCES professeurs(id) ON DELETE SET NULL,
    FOREIGN KEY (module_id) REFERENCES modules(id) ON DELETE CASCADE,
    FOREIGN KEY (element_id) REFERENCES elements(id) ON DELETE CASCADE,
    FOREIGN KEY (filiere_id) REFERENCES filiere(id) ON DELETE CASCADE,
    FOREIGN KEY (salle_id) REFERENCES salles(id) ON DELETE CASCADE,
    FOREIGN KEY (semaine_debut_id) REFERENCES semaines(id) ON DELETE CASCADE,
    FOREIGN KEY (semaine_fin_id) REFERENCES semaines(id) ON DELETE CASCADE,
    FOREIGN KEY (creneau_id) REFERENCES creneaux(id) ON DELETE CASCADE,
    FOREIGN KEY (groupe_id) REFERENCES groupes(id) ON DELETE CASCADE
);

-- Insertion des créneaux horaires
INSERT INTO creneaux (heure_debut, heure_fin) VALUES 
('08:30:00', '10:30:00'),
('08:30:00', '12:30:00'),
('10:30:00', '12:30:00'),
('14:30:00', '16:30:00'),
('16:30:00', '18:30:00'),
('14:30:00', '18:30:00');

-- Insertion des semaines ("semaine1" à "semaine20")
INSERT INTO semaines (semaine) VALUES
('1'), ('2'), ('3'), ('4'), ('5'), 
('6'), ('7'), ('8'), ('9'), ('10'), 
('11'), ('12'), ('13'), ('14'), ('15'),
('16'), ('17'), ('18'), ('19'), ('20');

INSERT INTO salles (nom, capacite) VALUES
('Amphi', 320),
('0.1', 63),
('0.2', 72),
('0.3', 0),
('0.5', 129),
('0.6', 150),
('0.7', 150),
('0.8', 150),
('0.9', 0),
('1.1', 132),
('1.2', 66),
('1.3', 66),
('1.4', 140),
('1.5', 66),
('1.6', 66),
('1.7', 66),
('1.8', 66),
('2.1', 70),
('2.2', 51),
('2.3', 70),
('2.4', 51),
('2.5', 51),
('2.6', 51),
('2.7', 51),
('2.8', 51),
('2.9', 51),
('2.10', 51),
('2.11', 51),
('2.12', 51),
('2.13', 51),
('ATELIER Mecanique', 0),
('ATELIER Electrotechnique', 0),
('Atelier Automatique et Instrumentation', 0),
('Atelier API', 0),
('Atelier Reseaux', 0),
('Atelier Telecom', 0),
('Atelier Systemes Embarques', 0),
('Atelier Informatique Industriel', 0),
('Atelier Electronique Analogique', 0),
('Atelier Electronique Numerique', 0),
('Atelier Physique', 0),
('Atelier 11', 0),
('Atelier 12', 0);

INSERT INTO groupes (label) VALUES
("Gr1"),
("Gr2"),
("Gr3"),
("Gr4"),
("Gr1.1"),
("Gr1.2"),
("Gr1.3"),
("Gr2.1"),
("Gr2.2"),
("Gr2.3"),
("Gr3.1"),
("Gr3.2"),
("Gr3.3");