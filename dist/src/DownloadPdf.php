<?php

require_once('vendor/autoload.php');
require_once('db.php'); // Include the database connection

function generatePDF($id) {

    global $pdo; // Access the database connection

    // Create a new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('EMSI');
    $pdf->SetTitle('Convention');
    $pdf->SetSubject('Convention du stage');
    $pdf->SetKeywords('PDF, stage, convention, PHP');

    // Add a page to the PDF
    $pdf->AddPage();

    // SQL query to retrieve data
    $sql = "SELECT matricule, nom, entreprise, datedebut, datefin FROM stage WHERE matricule = :id";
    
    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Bind the parameter
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the query
    $stmt->execute();

    // Fetch the data
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Your PDF content with database values
    $content = <<<EOD
        <body>
            <div style="margin-top: 10px; margin-left: 10px;">
                <a href="https://www.emsi.ma" style="text-decoration: none;">
                    <img style="height: 20px; margin-right: 2px;" src="https://www.emsi.ma/wp-content/uploads/2020/07/logo-1.png" alt="logo">
                </a>
            </div>
            <div style="text-align: center; margin-top: 14px; font-size: 20px; font-weight: bold;">ECOLE MAROCAINE DES SCIENCES DE L'INGENIEUR</div>
            <div style="text-align: center; margin-top: 52px; font-size: 24px; font-weight: bold;">Convention du stage</div>
            <div style="margin-left: 24px; padding: 5px; margin-top: 14px; font-size: 18px; font-weight: 500;">
                <p style="margin: 5px; padding: 2px;">Matricule: {$result['matricule']}</p>
                <p style="margin: 5px; padding: 2px;">Nom: {$result['nom']}</p>
                <p style="margin: 5px; padding: 2px;">Entreprise: {$result['entreprise']}</p>
                <p style="margin: 5px; padding: 2px;">Date début: {$result['datedebut']}</p>
                <p style="margin: 5px; padding: 2px;">Date fin: {$result['datefin']}</p>
            </div>
        </body>
    EOD;

    // Output the custom content to the PDF with HTML styles
    $pdf->writeHTML($content, true, false, true, false, '');

    // Set the response headers for PDF download
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="Convention du stage');

    // Output the PDF to the browser
    $pdf->Output();
    exit;

}
if (isset($_POST["download"])) {
    $id = $_POST["matricule"]; // Assuming that "matricule" is the name of the field containing the student ID
    generatePDF($id);
}
?>
