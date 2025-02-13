<?php
require '../config.php';
require '../tcpdf/tcpdf.php';

// Récupérer les données de l'emploi du temps
$query = "
    SELECT edt.id, p.nom AS professeur, e.nom AS element, s.nom AS salle, 
           c.heure_debut, c.heure_fin, edt.jour, sd.semaine AS semaine_debut, sf.semaine AS semaine_fin
    FROM emplois_du_temps edt
    JOIN professeurs p ON edt.prof_id = p.id
    JOIN elements e ON edt.element_id = e.id
    JOIN salles s ON edt.salle_id = s.id
    JOIN creneaux c ON edt.creneau_id = c.id
    JOIN semaines sd ON edt.semaine_debut_id = sd.id
    JOIN semaines sf ON edt.semaine_fin_id = sf.id
";
$emplois = $pdo->query($query)->fetchAll();

// Création du document PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Gestion Emplois du Temps');
$pdf->SetTitle('Emplois du Temps');
$pdf->SetHeaderData('', 0, 'Emplois du Temps', '');
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->AddPage();

// Titre
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, "Emplois du Temps", 0, 1, 'C');
$pdf->Ln(5);

// Table Header
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(40, 10, "Professeur", 1);
$pdf->Cell(40, 10, "Élément", 1);
$pdf->Cell(25, 10, "Salle", 1);
$pdf->Cell(20, 10, "Jour", 1);
$pdf->Cell(35, 10, "Créneau", 1);
$pdf->Cell(25, 10, "Semaines", 1);
$pdf->Ln();

// Remplissage des données
$pdf->SetFont('helvetica', '', 10);
foreach ($emplois as $emploi) {
    $pdf->Cell(40, 10, $emploi['professeur'], 1);
    $pdf->Cell(40, 10, $emploi['element'], 1);
    $pdf->Cell(25, 10, $emploi['salle'], 1);
    $pdf->Cell(20, 10, $emploi['jour'], 1);
    $pdf->Cell(35, 10, $emploi['heure_debut'] . " - " . $emploi['heure_fin'], 1);
    $pdf->Cell(25, 10, "S" . $emploi['semaine_debut'] . " - S" . $emploi['semaine_fin'], 1);
    $pdf->Ln();
}

// Générer le fichier PDF
$pdf->Output('emplois_du_temps.pdf', 'D');
?>
