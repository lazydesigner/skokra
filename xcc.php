<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the cropped image data sent from the client
    $croppedImage = $_POST['image'];

    // Remove the base64 data prefix
    $croppedImage = str_replace('data:image/png;base64,', '', $croppedImage);
    $croppedImage = str_replace(' ', '+', $croppedImage);

    // Decode the base64 image data
    $decodedImage = base64_decode($croppedImage);

    unlink('uploads/'.basename($_POST['imageName']));
    // Generate a unique filename for the cropped image
    $fileName = basename($_POST['imageName']);

    // Specify the path where the cropped image will be saved
    $filePath = 'uploads/' . $fileName;

    // Save the cropped image to the server
    file_put_contents($filePath, $decodedImage);

    echo json_encode(['status'=>200]);
} else {
    // If the request method is not POST, redirect to the index page
    echo json_encode(['status'=>400]);
    exit;
}
?>
