<html>
    <body>
        <? echo "hola todos con bind mount, y docker compose 7"; ?>

<?php
$servername = "localhost";
$username = "root";
$password = "example";
$dbname = "dbprueba";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT nombre FROM prueba";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "nombre: " . $row["nombre"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>


        
    </body>
</html>
