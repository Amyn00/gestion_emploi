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
);

-- Table des Filiere
CREATE TABLE filiere (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    abrv VARCHAR(7) NOT NULL,
    departement_id INT,
    prof_id INT,
    FOREIGN KEY (prof_id) REFERENCES professeurs(id) ON DELETE SET NULL,
    FOREIGN KEY (departement_id) REFERENCES departement(id) ON DELETE SET NULL
);

-- Table des Semetres
CREATE TABLE semestres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(10) NOT NULL,
    annee INT NOT NULL,
    filiere_id INT,
    FOREIGN KEY (filiere_id) REFERENCES filiere(id) ON DELETE CASCADE
);

-- Table des modules
CREATE TABLE modules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    code VARCHAR(50) UNIQUE NOT NULL,
    filiere_id INT,
    semestre_id INT,
    FOREIGN KEY (semestre_id) REFERENCES semestres(id) ON DELETE CASCADE,
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
    semestre_id INT,
    FOREIGN KEY (semestre_id) REFERENCES semestres(id) ON DELETE CASCADE,
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

INSERT INTO salles (nom, capacite, nb_exam) VALUES
('Amphi', 320, 90),
('0.1', 63, 21),
('0.2', 72, 30),
('0.3', 0, 0),
('0.5', 129, 69),
('0.6', 150, 51),
('0.7', 150, 51),
('0.8', 150, 51),
('0.9', 0, 0),
('1.1', 132, 60),
('1.2', 66, 30),
('1.3', 66, 30),
('1.4', 140, 74),
('1.5', 66, 30),
('1.6', 66, 30),
('1.7', 66, 30),
('1.8', 66, 30),
('2.1', 70, 37),
('2.2', 51, 17),
('2.3', 70, 37),
('2.4', 51, 17),
('2.5', 51, 17),
('2.6', 51, 17),
('2.7', 51, 17),
('2.8', 51, 17),
('2.9', 51, 17),
('2.10', 51, 17),
('2.11', 51, 17),
('2.12', 51, 17),
('2.13', 51, 17),
('ATELIER Mecanique', 0, 0),
('ATELIER Electrotechnique', 0, 0),
('Atelier Automatique et Instrumentation', 0, 0),
('Atelier API', 0, 0),
('Atelier Reseaux', 0, 0),
('Atelier Telecom', 0, 0),
('Atelier Systemes Embarques', 0, 0),
('Atelier Informatique Industriel', 0, 0),
('Atelier Electronique Analogique', 0, 0),
('Atelier Electronique Numerique', 0, 0),
('Atelier Physique', 0, 0),
('Atelier 11', 0, 0),
('Atelier 12', 0, 0);

INSERT INTO equipements(nom) VALUES
('Prise'),
('Video Projecteur');

INSERT INTO salle_equipements (salle_id, equipement_id) VALUES
(18,1),
(19,1),
(20,1),
(21,1),
(22,1),
(23,1),
(24,1),
(25,1),
(26,1),
(27,1),
(28,1),
(29,1),
(30,1);

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

INSERT INTO filiere (nom, abrv, departement_id, prof_id) VALUES
('1ère année Cycle Ingénieur - Filière Genie du developpement numerique et Cybersecurite', 'GDNC-1',1,39),
('1ère année Cycle Ingénieur - Filière Ingénierie en Science de Données et Intelligence Artificielle', 'ISDIA-1',1,30),
('1ère année Cycle Ingénieur - Filière Génie Informatique', 'GINFO-1',1, 28),
('1ère année Cycle Ingénieur - Filière Génie Mécanique','GM-1', 2, 32),
('1ère année Cycle Ingénieur - Filière Génie Energétique et systèmes intelligents','GESI-1', 2, 8),
('1ère année Cycle Ingénieur - Filière Génie Mécatronique','GMT-1', 2, 49),
('1ère année Cycle Ingénieur - Filière Génie Industriel','GINDUS-1', 2, 34),
('1ère année Cycle Ingénieur - Filière Génie des Systèmes communicants et sécurité informatique','GSCSI-1', 3, 24),
('1ère année Cycle Ingénieur - Filière Ingénierie Informatique, Intelligence Artificielle et Confiance Numérique','3IACN-1', 3, 3),
('1ère année Cycle Ingénieur - Filière Ingénierie des Systèmes Embarqués et Intelligence Artificielle','ISEIA-1', 4, 22),
('1ère année Cycle Ingénieur - Filière Ingénierie Logicielle et Intelligence Artificielle', 'ILIA-1',4, 9),

('2ème année Cycle Ingénieur - Filière Genie du developpement numerique et Cybersecurite', 'GDNC-2',1,39),
('2ème année Cycle Ingénieur - Filière Ingénierie en Science de Données et Intelligence Artificielle', 'ISDIA-2',1,30),
('2ème année Cycle Ingénieur - Filière Génie Informatique', 'GINFO-2',1, 28),
('2ème année Cycle Ingénieur - Filière Génie Mécanique','GM-2', 2, 32),
('2ème année Cycle Ingénieur - Filière Génie Energétique et systèmes intelligents','GESI-2', 2, 8),
('2ème année Cycle Ingénieur - Filière Génie Mécatronique','GMT-2', 2, 49),
('2ème année Cycle Ingénieur - Filière Génie Industriel','GINDUS-2', 2, 34),
('2ème année Cycle Ingénieur - Filière Génie des Systèmes communicants et sécurité informatique','GSCSI-2', 3, 24),
('2ème année Cycle Ingénieur - Filière Ingénierie Informatique, Intelligence Artificielle et Confiance Numérique','3IACN-2', 3, 3),
('2ème année Cycle Ingénieur - Filière Ingénierie des Systèmes Embarqués et Intelligence Artificielle','ISEIA-2', 4, 22),
('2ème année Cycle Ingénieur - Filière Ingénierie Logicielle et Intelligence Artificielle', 'ILIA-2',4, 9),

('3ème année Cycle Ingénieur - Filière Genie du developpement numerique et Cybersecurite', 'GDNC-3',1,39),
('3ème année Cycle Ingénieur - Filière Ingénierie en Science de Données et Intelligence Artificielle', 'ISDIA-3',1,30),
('3ème année Cycle Ingénieur - Filière Génie Informatique', 'GINFO-3',1, 28),
('3ème année Cycle Ingénieur - Filière Génie Mécanique','GM-3', 2, 32),
('3ème année Cycle Ingénieur - Filière Génie Energétique et systèmes intelligents','GESI-3', 2, 8),
('3ème année Cycle Ingénieur - Filière Génie Mécatronique','GMT-3', 2, 49),
('3ème année Cycle Ingénieur - Filière Génie Industriel','GINDUS-3', 2, 34),
('3ème année Cycle Ingénieur - Filière Génie des Systèmes communicants et sécurité informatique','GSCSI-3', 3, 24),
('3ème année Cycle Ingénieur - Filière Ingénierie Informatique, Intelligence Artificielle et Confiance Numérique','3IACN-3', 3, 3),
('3ème année Cycle Ingénieur - Filière Ingénierie des Systèmes Embarqués et Intelligence Artificielle','ISEIA-3', 4, 22),
('3ème année Cycle Ingénieur - Filière Ingénierie Logicielle et Intelligence Artificielle', 'ILIA-3',4, 9),

('1ère année Cycle préparatoire SECTION A','CP1-SA', 5, 31),
('1ère année Cycle préparatoire SECTION B','CP1-SB', 5, 31),
('1ère année Cycle préparatoire SECTION C','CP1-SC', 5, 31),
('2ème année Cycle préparatoire','CP2', 5, 31);

INSERT INTO semestres (nom, annee, filiere_id) VALUES
('S1', 1, 1), ('S2', 1, 1),
('S1', 1, 2), ('S2', 1, 2),
('S1', 1, 3), ('S2', 1, 3),
('S1', 1, 4), ('S2', 1, 4),
('S1', 1, 5), ('S2', 1, 5),
('S1', 1, 6), ('S2', 1, 6),
('S1', 1, 7), ('S2', 1, 7),
('S1', 1, 8), ('S2', 1, 8),
('S1', 1, 9), ('S2', 1, 9),
('S1', 1, 10), ('S2', 1, 10),
('S1', 1, 11), ('S2', 1, 11),

('S3', 2, 12), ('S4', 1, 12),
('S3', 2, 13), ('S4', 1, 13),
('S3', 2, 14), ('S4', 1, 14),
('S3', 2, 15), ('S4', 1, 15),
('S3', 2, 16), ('S4', 1, 16),
('S3', 2, 17), ('S4', 1, 17),
('S3', 2, 18), ('S4', 1, 18),
('S3', 2, 19), ('S4', 1, 19),
('S3', 2, 20), ('S4', 1, 20),
('S3', 2, 21), ('S4', 1, 21),
('S3', 2, 22), ('S4', 1, 22),

('S5', 3, 23), ('S6', 3, 23),
('S5', 3, 24), ('S6', 3, 24),
('S5', 3, 25), ('S6', 3, 25),
('S5', 3, 26), ('S6', 3, 26),
('S5', 3, 27), ('S6', 3, 27),
('S5', 3, 28), ('S6', 3, 28),
('S5', 3, 29), ('S6', 3, 29),
('S5', 3, 30), ('S6', 3, 30),
('S5', 3, 31), ('S6', 3, 31),
('S5', 3, 32), ('S6', 3, 32),
('S5', 3, 33), ('S6', 3, 33),

('S1', 1, 34), ('S2', 1, 23),
('S1', 1, 35), ('S2', 1, 24),
('S1', 1, 36), ('S2', 1, 25),
('S3', 2, 37), ('S4', 2, 26);

INSERT INTO departement(nom,abrv,prof_id)VALUES
('Génie électrique et informatique','GEI'),
('Génie Industriel', 'GIND'),
('Sciences de Données et Systèmes Communicants','SDSC'),
('Génie des systèmes intelligents','GSI'),
('Cycle préparatoires','CP');

INSERT INTO professeurs (nom, prenom, email, telephone) VALUES
('AIRAJ', 'MOHAMMED', '', ''),
('ALFIDI', 'Mohammed', '', ''),
('BERRADA', 'Mohammed', '', ''),
('CHALH', 'Zakaria', '', ''),
('EL FADILI', 'Hakim', '', ''),
('EL HAMMAMI', 'YOUNESS', '', ''),
('EZZOUHAIRI', 'Abdellatif', '', ''),
('HIHI', 'HICHAM', '', ''),
('IDRISSI KHAMLICHI', 'YOUNESS', '', ''),
('KENZI', 'Adil', '', ''),
('KHAISSIDI', 'Ghizlane', '', ''),
('MANSOURI', 'Anass', '', ''),
('MAZER', 'Said', '', ''),
('MOUSTABCHIR', 'HASSANE', '', ''),
('MRABTI', 'Mostafa', '', ''),
('OUAHI', 'Mohamed', '', ''),
('OUGHDIR', 'LAHCEN', '', ''),
('SALHI', 'MOHAMED', '', ''),
('YOUSSFI', 'AHMED', '', ''),
('ABERQI', ' AHMED', '', ''),
('ACHAHBAR', 'ASMAE', '', ''),
('ALAMI MARKTANI', 'MALIKA', '', ''),
('ALLA', 'LHOUSSAINE', '', ''),
('BALBOUL', 'YOUNES', '', ''),
('BELLAMINE', 'INSAF', '', ''),
('BEN HADDOUCH', 'KHALIL', '', ''),
('BENNOUNA', ' Fatima', '', ''),
('BOULAALAM', 'ABDELHAK', '', ''),
('CHOUGRAD', 'Hiba', '', ''),
('EL AKKAD', 'NABIL', '', ''),
('ELHAJ BENALI', 'SAFAE', '', ''),
('EL HAINI', 'JAMILA', '', ''),
('EL HASSANI', 'HIND', '', ''),
('EL KHATTABI', 'SOUAD', '', ''),
('FARHANE', 'Youness', '', ''),
('FEKKAK', 'Fatima-Ezzahra', '', ''),
('HADDOUCH', 'Khalid', '', ''),
('HRAOUI', 'Said', '', ''),
('JEGHAL', 'Adil', '', ''),
('KARITE', 'Touria', '', ''),
('LAAOUINA', 'LOUBNA', '', ''),
('LAHRECH', 'Khadija', '', ''),
('LAKHRISSI', 'Younes', '', ''),
('MADANI-ALAOUI', 'KHADIJA', '', ''),
('MELLOULI', 'EL MEHDI', '', ''),
('MOTAHHIR', 'SAAD', '', ''),
('NASRI', 'Sanae', '', ''),
('OUDGHIRI BENTAIE', 'Mohammed', '', ''),
('SAYYOURI', 'M\'HAMED', '', ''),
('ALAOUI', 'MERIEM', '', ''),
('AMANE', 'MERYEM', '', ''),
('AZRAR', 'Abdellhadi', '', ''),
('BELKEBIR', ' HICHAM', '', ''),
('BOULAICH', 'MOHAMMED ALI', '', ''),
('BOUMAIZ', 'Marwa', '', ''),
('CHAIBI', 'YASSINE', '', ''),
('CHERKAOUI SEMMOUNI', 'Meryem', '', ''),
('CHETIOUI', 'Kaouthar', '', ''),
('DAHBI', 'MANAR', '', ''),
('EL AFOU', 'Youssef', '', ''),
('EL GANNOUR', 'OUSSAMA', '', ''),
('EL OUAZZANI', 'ZAKARIAE', '', ''),
('JERROUDI', 'AMINE', '', ''),
('KHOUMSSI', 'KHAOULA', '', ''),
('MAZGOURI', 'ZAKARIA', '', ''),
('MONTASSIR', 'Soufiane', '', ''),
('MOUNTASSER', 'IMAD EDDINE', '', ''),
('MOUSSAOUI', 'Hanae', '', ''),
('MOUTAIB', 'Mohammed', '', ''),
('OUDIJA', 'MUSTAPHA', '', ''),
('OUHAIBI', 'SALMA', '', ''),
('RASSIL', 'ASMAA', '', ''),
('SOSSI-ALAOUI', 'Safae', '', ''),
('TOUZANI', 'Hajar', '', ''),
('YAKINE', 'Fadoua', '', ''),
('ELBDOURI', 'Abdelali ', '', '');