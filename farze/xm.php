<?php
set_time_limit(0);

function scrapeImages($url, $visitedUrls, &$imgUrls) {
    if (in_array($url, $visitedUrls)) {
        return;
    }

    $visitedUrls[] = $url;
    $html = file_get_contents($url);
    $dom = new DOMDocument;
    @$dom->loadHTML($html);

    $imgTags = $dom->getElementsByTagName('img');
    foreach ($imgTags as $imgTag) {
        $src = $imgTag->getAttribute('src');
        if ($src) {
            $imgUrls[] = $src;
        }
        $dataSrc = $imgTag->getAttribute('data-src');
        if ($dataSrc) {
            $imgUrls[] = $dataSrc;
        }
    }

    $links = $dom->getElementsByTagName('a');
    foreach ($links as $link) {
        $nextUrl = $link->getAttribute('href');
        if (filter_var($nextUrl, FILTER_VALIDATE_URL)) {
            scrapeImages($nextUrl, $visitedUrls, $imgUrls);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['url'];
    $imgUrls = [];
    $visitedUrls = [];

    scrapeImages($url, $visitedUrls, $imgUrls);

    // Output JSON response with appropriate headers
    header('Content-Type: application/json');
    echo json_encode(['imgUrls' => $imgUrls]);
    exit;
}

// If not a POST request, serve the HTML content
?>