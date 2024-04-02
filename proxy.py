import time
import random
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException

# Function to randomly select a proxy
def get_random_proxy():
    proxies = [
         '162.19.7.48:55060',
        '67.213.212.47:32266',
        # Add more proxies as needed
    ]
    return random.choice(proxies)

# Main function
def main():
    # Configure Chrome options
    chrome_options = Options()
    chrome_options.add_argument('--proxy-server={}'.format(get_random_proxy()))

    # Start Chrome browser
    driver = webdriver.Chrome(options=chrome_options)

    # Perform search
    query = 'studypedia.in'
    driver.get('https://www.google.com')
    search_box = driver.find_element(By.NAME, 'q')
    search_box.send_keys(query)
    search_box.send_keys(Keys.RETURN)

    # Wait for search results to load
    try:
        WebDriverWait(driver, 60).until(EC.presence_of_element_located((By.CSS_SELECTOR, 'div.r')))
    except TimeoutException:
        print("Timed out waiting for search results to load")
        driver.quit()
        return

    # Check if CAPTCHA is present
    if 'I am not a robot' in driver.page_source:
        input('Please complete the CAPTCHA manually and press Enter to continue...')

    # Click on the first link
    try:
        first_link = WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.CSS_SELECTOR, 'div.r a')))
        first_link.click()
    except TimeoutException:
        print("Timed out waiting for the first link to become clickable")
        driver.quit()
        return

    # Wait for the page to load
    time.sleep(3)

    # Open 10 to 20 links on the page
    for _ in range(random.randint(10, 20)):
        links = driver.find_elements(By.TAG_NAME, 'a')
        link = random.choice(links)
        link.click()
        time.sleep(3)

    # Close random tabs
    for _ in range(random.randint(5, 10)):
        handles = driver.window_handles
        random_handle = random.choice(handles)
        driver.switch_to.window(random_handle)
        driver.close()

    # Change proxy
    driver.quit()

if __name__ == "__main__":
    main()
