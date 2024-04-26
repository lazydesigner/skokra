from oauth2client.service_account import ServiceAccountCredentials
import httplib2

def send_index_requests(urls, request_type):
    SCOPES = ["https://www.googleapis.com/auth/indexing"]
    ENDPOINT = "https://indexing.googleapis.com/v3/urlNotifications:publish"
    JSON_KEY_FILE = "./poojamahajan-4ba49968a0b7.json"  # Update the path to your API key file

    credentials = ServiceAccountCredentials.from_json_keyfile_name(JSON_KEY_FILE, scopes=SCOPES)
    http = credentials.authorize(httplib2.Http())

    for url in urls:
        content = str({'url': url, 'type': request_type})
        response, content = http.request(ENDPOINT, method="POST", body=content)
        output = response['status']
        print(f"Request for {url}: {output}")

# poojamahajan usagcall-girls/ls_to_index = [
urls_to_index = [
    "https://poojamahajan.com/call-girls/ambegaon/katraj/call-girl-491",
    "https://poojamahajan.com/call-girls/wanowarie/fatima-nagar/call-girl-492",
    "https://poojamahajan.com/call-girls/wanowarie/salunke-vihar/call-girl-493",
    "https://poojamahajan.com/call-girls/wanowarie/salunke-vihar/call-girl-493"
]
request_type = "URL_UPDATED"  # Choose the request type

send_index_requests(urls_to_index, request_type)
