<?php
// 1. Koble til databasen
$servername = "localhost";
$username = "root";
$password = ""; // tomt passord i XAMPP
$dbname = "kontaktskjema"; // <-- bytt til navnet på databasen du bruker

$conn = new mysqli($servername, $username, $password, $dbname);

// 2. Sjekk tilkobling
if ($conn->connect_error) {
    die("Tilkobling feilet: " . $conn->connect_error);
}

// 3. Hent data fra skjema
$navn = $_POST['navn'];
$epost = $_POST['epost'];
$melding = $_POST['melding'];

// 4. Sett inn i databasen
$sql = "INSERT INTO meldinger (navn, epost, melding) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $navn, $epost, $melding);

if ($stmt->execute()) {
    echo "Takk for meldingen!";
} else {
    echo "Noe gikk galt: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
