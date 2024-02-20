<?php
// Function to add watermark to an image
// function addWatermark($sourceImagePath, $watermarkImagePath, $outputImagePath) {
//     // Open the source image
//     $sourceImage = imagecreatefromjpeg($sourceImagePath); // Change the function based on the image type

//     // Open the watermark image
//     $watermarkImage = imagecreatefrompng($watermarkImagePath);

//     // Get the dimensions of the source image and watermark image
//     $sourceWidth = imagesx($sourceImage);
//     $sourceHeight = imagesy($sourceImage);
//     $watermarkWidth = imagesx($watermarkImage);
//     $watermarkHeight = imagesy($watermarkImage);

//     // Calculate the position to place the watermark (bottom right corner in this example)
//     $positionX = $sourceWidth - $watermarkWidth - 10; // Adjust as needed
//     $positionY = $sourceHeight - $watermarkHeight - 10; // Adjust as needed

//     // Merge the source image with the watermark
//     imagecopy($sourceImage, $watermarkImage, $positionX, $positionY, 0, 0, $watermarkWidth, $watermarkHeight);

//     // Save the final image
//     imagejpeg($sourceImage, $outputImagePath); // Change the function based on the desired output format

//     // Free up memory
//     imagedestroy($sourceImage);
//     imagedestroy($watermarkImage);
// }


function addWatermark($sourceImagePath, $watermarkImagePath, $outputImagePath) {
    // Open the source image
    $sourceImage = imagecreatefromjpeg($sourceImagePath); // Change the function based on the image type

    // Open the watermark image
    $watermarkImage = imagecreatefrompng($watermarkImagePath);

    // Get the dimensions of the source image and watermark image
    $sourceWidth = imagesx($sourceImage);
    $sourceHeight = imagesy($sourceImage);
    $watermarkWidth = imagesx($watermarkImage);
    $watermarkHeight = imagesy($watermarkImage);

    // Calculate the position to place the watermark at the center
    $positionX = ($sourceWidth - $watermarkWidth) / 2;
    $positionY = ($sourceHeight - $watermarkHeight) / 2;

    // Merge the source image with the watermark
    imagecopy($sourceImage, $watermarkImage, $positionX, $positionY, 0, 0, $watermarkWidth, $watermarkHeight);

    // Save the final image
    imagejpeg($sourceImage, $outputImagePath); // Change the function based on the desired output format

    // Free up memory
    imagedestroy($sourceImage);
    imagedestroy($watermarkImage);
}


// Process the uploaded image and add watermark
if(isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $uploadDir = 'uploads/'; // Directory to store uploaded images
    $uploadedFile = $uploadDir . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFile);

    $watermarkImage = './assets/images/SKOKRA+LOGO+NEW+(2).webp.png'; // Watermark image path
    $outputFile = $uploadDir . 'watermarked_' . basename($_FILES['image']['name']);

    addWatermark($uploadedFile, $watermarkImage, $outputFile);
    
    echo 'Watermarked image saved: ' . $outputFile;
}
?>
