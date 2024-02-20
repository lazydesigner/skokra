<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Image Upload with Watermark</title>
</head>
<body>

<form action="./watermark.php" method="post" enctype="multipart/form-data">
  <label for="image">Choose an image:</label>
  <input type="file" name="image" id="image" accept="image/*" required>
  <br>
  <button type="submit">Upload and Add Watermark</button>
</form>

</body>
</html>
