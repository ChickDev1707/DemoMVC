import selenium
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.common.keys import Keys
import time
import unittest

class ExampleTest(unittest.TestCase):
    def setUp(self):
        self.driver= webdriver.Chrome("C:\Program Files (x86)\chromedriver.exe")
        self.driver.get("http://localhost/LibraryManagementSystem/")
        
    # def convertDate(self, date):
    #     splitDate = date.split("-")
    #     return 
    def createReaderCard(self, data):
        # loginLink = self.driver.find_element_by_link_text("")
        # loginLink.click()

        nameInput = self.driver.find_element_by_name("name")
        nameInput.send_keys(data["name"])


        dateOfBirthInput = self.driver.find_element_by_name("date_of_birth")
        dateOfBirthInput.send_keys(data["dateOfBirth"])
        # script = 'document.geElementByName("date_of_birth").value = "'+ data['dateOfBirth']+'"';
        # print(script);
        # selenium.executeScript(script);

        addressInput = self.driver.find_element_by_name("address")
        addressInput.send_keys(data["address"])

        emailInput = self.driver.find_element_by_name("email")
        emailInput.send_keys(data["email"])

        createDate = self.driver.find_element_by_name("create_date")
        createDate.send_keys(data["createDate"])

        # createCard = self.driver.find_element_by_name("submit")
        # createCard.click()

        # messageBox = self.driver.find_element_by_css_selector("#main-message-box p")
        # message = messageBox.get_attribute('innerHTML')
        # return message
    
    def test_1(self):
        data = {"name": "thuan", "dateOfBirth": "2001-05-19",
                "address": "abc", "email": "thuancoixy234786@gmail.com", 
                "createDate": "2001-05-19"}
        self.createReaderCard(data)
        # self.assertEqual(self.createReaderCard(data), "Tạo thẻ độc giả thành công!")
        time.sleep(5)
    # def test_2(self):
    #     data = {"name": "son", "dateOfBirth": "19-5-2001",
    #             "address": "abc", "email": "thuancoixy234786@gmail.com", 
    #             "createDate": "1-1-2020"}
        
    #     # self.assertEqual(self.runLogin("", ""), "Chưa nhập Tên Truy Nhập hoặc Mật Khẩu")
    #     self.createReaderCard(data);
    #     time.sleep(5)

    def tearDown(self):
        self.driver.close()
        

if __name__ == "__main__":
    unittest.main()