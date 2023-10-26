<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Assignment 5</title>
  </head>

  <body>
    <h1>Upload a Text File and Enter a String</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
      <input type="file" name="file" />
      <input type="text" name="name" placeholder="Enter a name" />
      <input type="submit" value="Upload" />
    </form>
    <h2>Database Content:</h2>
    <div id="database-content">
      <!-- Display database content here -->
    </div>
  </body>
</html>
