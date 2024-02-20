<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Scraper</title>
    <style>
        #loading {
            display: none;
            margin-top: 20px;
        }

        #progress {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Image Scraper</h1>
    <form id="scrapeForm">
        <label for="url">Enter website URL:</label>
        <input type="text" id="url" name="url" required>
        <button type="submit">Scrape Images</button>
    </form>
    <div id="loading">Processing...</div>
    <div id="progress">Processing URL: <span id="currentUrl"></span></div>
    <div id="result"></div>

    <script>
        document.getElementById('scrapeForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const url = document.getElementById('url').value;
            const loadingDiv = document.getElementById('loading');
            const progressDiv = document.getElementById('progress');
            const currentUrlSpan = document.getElementById('currentUrl');
            const resultDiv = document.getElementById('result');
            
            loadingDiv.style.display = 'block';
            progressDiv.style.display = 'none';

            fetch('xm.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'url=' + encodeURIComponent(url),
            })
            .then(response => response.json())
            .then(data => {
                loadingDiv.style.display = 'none';
                progressDiv.style.display = 'block';

                if (data.imgUrls && data.imgUrls.length > 0) {
                    data.imgUrls.forEach((imgUrl, index) => {
                        const imgElement = document.createElement('img');
                        imgElement.src = imgUrl;
                        resultDiv.appendChild(imgElement);
                    });
                } else {
                    resultDiv.textContent = 'No images found.';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                loadingDiv.style.display = 'none';
                progressDiv.style.display = 'none';
            });
        });
    </script>
</body>
</html>
