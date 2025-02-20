<?php
require '../config.php';
require '../tcpdf/tcpdf.php';

// Charger le logo
$logoPath = realpath('images/logo.png');
$logoExists = $logoPath && file_exists($logoPath);

// Récupérer les données de l'emploi du temps
$query = "
    SELECT 
        e.id, 
        p.nom AS prof_nom, p.prenom AS prof_prenom,
        f.nom AS nom_filiere,
        m.code AS code_module, 
        el.nom AS element_nom,  
        e.jour, 
        c.heure_debut, c.heure_fin,
        e.semaine_debut_id AS semaine_debut,
        e.semaine_fin_id AS semaine_fin,
        s.nom AS salle
    FROM emplois_du_temps e
    JOIN professeurs p ON e.prof_id = p.id
    JOIN elements el ON e.element_id = el.id
    JOIN salles s ON e.salle_id = s.id
    JOIN creneaux c ON e.creneau_id = c.id
    JOIN modules m ON e.module_id = m.id
    JOIN filiere f ON e.filiere_id = f.id
    ORDER BY f.nom, e.jour, c.heure_debut
";
$emplois = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);

// Organiser les données sous forme de tableau
$emplois_table = [];
foreach ($emplois as $emploi) {
    $emplois_table[$emploi['nom_filiere']][$emploi['jour']][$emploi['heure_debut']] = 
        "{$emploi['code_module']} : {$emploi['element_nom']}\n".
        "S{$emploi['semaine_debut']} - S{$emploi['semaine_fin']}\n".
        "{$emploi['salle']}\n".
        "{$emploi['prof_nom']} {$emploi['prof_prenom']}";
}

// Création du document PDF en mode paysage
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Gestion Emplois du Temps');
$pdf->SetTitle('Emplois du Temps');

// Ajouter une page
$pdf->AddPage();

// Insérer le logo
if ($logoExists) {
    $pdf->Image($logoPath, 10, 8, 30);
} else {
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->Cell(0, 10, "⚠ Logo non trouvé", 0, 1, 'L');
    $pdf->SetTextColor(0, 0, 0);
}

// Titre principal
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, "Emplois du Temps", 0, 1, 'C');
$pdf->Ln(3);

// Sous-titre avec filière et année universitaire
$pdf->SetFont('helvetica', 'I', 12);
$pdf->Cell(0, 10, "Filière : Genie du developpement numerique et Cybersecurite | Année Universitaire : 2024/2025", 0, 1, 'C');
$pdf->Ln(5);

// Jours et créneaux horaires
$jours = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
$creneaux = [
    "08:30:00" => "08:30-10:30",
    "10:30:00" => "10:30-12:30",
    "14:30:00" => "14:30-16:30",
    "16:30:00" => "16:30-18:30"
];

// Largeurs des colonnes
$col_widths = [35, 50, 50, 50, 50];

// En-tête du tableau
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell($col_widths[0], 10, "Jours / Créneaux", 1, 0, 'C');
foreach ($creneaux as $label) {
    $pdf->Cell($col_widths[1], 10, $label, 1, 0, 'C');
}
$pdf->Ln();

// Remplissage du tableau
$pdf->SetFont('helvetica', '', 9); // Réduction de la police pour éviter la superposition
foreach ($jours as $jour) {
    $pdf->Cell($col_widths[0], 25, $jour, 1, 0, 'C'); // Augmentation de la hauteur pour aérer les cellules
    foreach ($creneaux as $heure => $label) {
        $text = isset($emplois_table['Genie du developpement numerique et Cybersecurite'][$jour][$heure]) ? 
            $emplois_table['Genie du developpement numerique et Cybersecurite'][$jour][$heure] : "—";
        $pdf->MultiCell($col_widths[1], 25, $text, 1, 'C', false, 0); // Centrage et gestion des retours à la ligne
    }
    $pdf->Ln();
}

// Générer le fichier PDF
$pdf->Output('emplois_du_temps.pdf', 'D');
?>