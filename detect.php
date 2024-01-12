<?php 
function hasWatermark($userImagePath, $watermarkImagePath, $threshold = 0.9) {
    // Load user-uploaded image
    $userImage = imagecreatefromjpeg($userImagePath); // Change the function based on the image type

    // Load watermark image using Imagick
    $watermarkImage = new Imagick($watermarkImagePath);

    // Convert user image to Imagick
    $userImageImagick = new Imagick();
    $userImageImagick->readImageBlob(imagejpeg($userImage, null));

    // Compare structural similarity
    $result = $userImageImagick->compareImages($watermarkImage, Imagick::METRIC_MEANABSOLUTEERROR);

    // Free up memory
    imagedestroy($userImage);

    // Check if the structural similarity is below the threshold
    return $result[1] >= $threshold;
}


$userImagePath = './uploads/massage-2768833_640.jpg';
$watermarkImagePath = './assets/images/SKOKRA+LOGO+NEW+(2).webp.png';

if (hasWatermark($userImagePath, $watermarkImagePath)) {
    echo 'The user-uploaded image contains a watermark.';
} else {
    echo 'No watermark detected in the user-uploaded image.';
}

?>