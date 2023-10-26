<?php
    require_once 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    } 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $content = file_get_contents($_FILES["file"]["tmp_name"]);

        // Insert data into the database
        $sql = "INSERT INTO user_data (Name, Content) VALUES ('$name', '$content')";
        if ($conn->query($sql) === TRUE) {
            echo "Data uploaded successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Fetch and display database content
    $result = $conn->query("SELECT * FROM user_data");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['Name'];
            $content = $row['Content'];   
            echo "<table border='1px solid black'>";
            echo "<tr><th>ID</th><th>Name</th><th>Content</th></tr>"; // table header row
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$name</td>";
            echo "<td>$content</td>";
            echo "</tr>";
            echo "</table>";
        }
    } else {
        echo "No data in the database.";
    }

    $conn->close();

    
?>





 
  

 