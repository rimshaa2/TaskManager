from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By
import unittest
import time

class TaskManagerTests(unittest.TestCase):
    def setUp(self):
        options = Options()
        options.add_argument('--headless')
        options.add_argument('--no-sandbox')
        options.add_argument('--disable-dev-shm-usage')
        self.driver = webdriver.Chrome(options=options)
        self.driver.get("http://localhost:8000")  # Update port as needed

    def test_title(self):
        self.assertIn("Task Manager", self.driver.title)

    def test_login_form_presence(self):
        self.assertTrue(self.driver.find_element(By.ID, "login-form"))

    def test_invalid_login(self):
        self.driver.find_element(By.NAME, "username").send_keys("wronguser")
        self.driver.find_element(By.NAME, "password").send_keys("wrongpass")
        self.driver.find_element(By.ID, "login-button").click()
        time.sleep(1)
        self.assertIn("Invalid credentials", self.driver.page_source)

    def tearDown(self):
        self.driver.quit()

if __name__ == "__main__":
    unittest.main()
