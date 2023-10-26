<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="text" name="input_text" placeholder="Enter String here">
    <br>
    <br>
    <input type="file" name="file" accept=".txt">
    <br>
    <br>
    <button type="submit" name="Upload">Submit</button>
</form>

<?php
require_once 'dbconnect.php';
session_start();
if( !isset($_SESSION["user"])){
    header("location:login.php"); 
} elseif (isset($_SESSION["user"])){
    $username = $_SESSION["user"];
    
    echo "<h4>welcome back $username</h4>";
    echo "Your Current Data";
    echo "</br>";
    echo "</br>";

    $result = $conn->query("SELECT * FROM user_info WHERE user_name='$username'");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { // display table after logged in

            $id = $row['id'];
            $file_name = $row['file_name'];
            $file_content = $row['file_content']; 
            $input_string = $row['input_string'];   

            echo "<table border='1px solid black'>";
            echo "<tr><th>ID</th><th>File Name</th><th>File Content</th><th>Input String</th></tr>"; // table header row
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$file_name</td>";
            echo "<td>$file_content</td>";
            echo "<td>$input_string</td>";
            echo "</tr>";
            echo "</table>";
        }
    }

    if (isset($_FILES["file"])) {
        $file = $_FILES["file"];
        if ($file["error"] === UPLOAD_ERR_OK && $file["type"] === "text/plain") { //check txt file
            
            $content = file_get_contents($_FILES["file"]["tmp_name"]); // get file content
            $filename = $_FILES["file"]["name"]; // get file name
           
        } else {
            echo "Please upload a valid .txt file.";
        }    
    }

   
    if( isset($_POST['Upload'])){ 
        $string_input = $_POST['input_text'];
    
        $sql = "INSERT INTO user_info (file_name, file_content, input_string, user_name) VALUES ('$filename', '$content', '$string_input', '$username')";
        mysqli_query($conn,$sql);

        $result = $conn->query("SELECT * FROM user_info WHERE user_name='$username'");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { // display updated table after click submit

                $id = $row['id'];
                $file_name = $row['file_name'];
                $file_content = $row['file_content']; 
                $input_string = $row['input_string'];   

                echo "</br>";
                echo "</br>";
                echo "Your Updated Data";
                echo "</br>";
                echo "</br>";
                echo "<table border='1px solid black'>";
                echo "<tr><th>ID</th><th>File Name</th><th>File Content</th><th>Input String</th></tr>"; // table header row
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$file_name</td>";
                echo "<td>$file_content</td>";
                echo "<td>$input_string</td>";
                echo "</tr>";
                echo "</table>";
            }
        }
    }
}
?>



