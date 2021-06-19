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
        self.driver = webdriver.Chrome("C:\Program Files (x86)\chromedriver.exe")
        self.driver.get("http://localhost/LibraryManagementSystem/")
    
    def createReaderCard(self, data):

        nameInput  =self.driver.find_element_by_name("name")
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

        createCard = self.driver.find_element_by_name("submit_create_card")
        webdriver.ActionChains(self.driver).click(createCard).perform()

        messageBox = self.driver.find_element_by_css_selector("#main-message-box p")
        message = messageBox.get_attribute("innerText")
        return message
    

    # valid name data
    def test_1(self):
        data = {"name": "thuan", "dateOfBirth": "05-19-2001",
                "address": "abc", "email": "thuancoixy234786@gmail.com", 
                "createDate": "06-01-2021"}
        self.createReaderCard(data)
        self.assertEqual(self.createReaderCard(data), "Tạo thẻ độc giả thành công!")
        time.sleep(10)
    
    # invalid name includes number
    def test_2(self):
        data = {"name": "thuan123", "dateOfBirth": "05-19-2001",
                "address": "abc", "email": "thuancoixy234786@gmail.com",
                "createDate": "06-01-2021"}
        self.createReaderCard(data)
        self.assertEqual(self.createReaderCard(data), "Tên độc giả chỉ bao gồm các ký tự hoa thường và khoảng trắng!")
        # time.sleep(2)

    # invalid name includes special character
    def test_3(self):
        data = {"name": "thuan(!", "dateOfBirth": "05-19-2001",
                "address": "abc", "email": "thuancoixy234786@gmail.com",
                "createDate": "06-01-2021"}
        self.createReaderCard(data)
        self.assertEqual(self.createReaderCard(data), "Tên độc giả chỉ bao gồm các ký tự hoa thường và khoảng trắng!")
        time.sleep(2)
    
    #invalid name only includes spaces
    def test_4(self):
        data = {"name": "   ", "dateOfBirth": "05-19-2001",
                "address": "abc", "email": "thuancoixy234786@gmail.com",
                "createDate": "06-01-2021"}
        self.createReaderCard(data)
        self.assertEqual(self.createReaderCard(data), "Tên độc giả chỉ bao gồm các ký tự hoa thường và khoảng trắng!")
        time.sleep(2)
    
    # address valid
    def test_5(self):
        data = {"name": "thuan", "dateOfBirth": "05-19-2001",
                "address": "dong nai", "email": "thuancoixy234786@gmail.com",
                "createDate": "06-01-2021"}
        self.createReaderCard(data)
        self.assertEqual(self.createReaderCard(data), "Tạo thẻ độc giả thành công!")
        time.sleep(2)
    
    # address includes number
    def test_6(self):
        data = {"name": "thuan", "dateOfBirth": "05-19-2001",
                "address": "123", "email": "thuancoixy234786@gmail.com",
                "createDate": "06-01-2021"}
        self.createReaderCard(data)
        self.assertEqual(self.createReaderCard(data), "Tạo thẻ độc giả thành công!")
        time.sleep(2)
    
    # address includes special character
    def test_7(self):
        data = {"name": "thuan", "dateOfBirth": "05-19-2001",
                "address": "ab   c*", "email": "thuancoixy234786@gmail.com",
                "createDate": "06-01-2021"}
        self.createReaderCard(data)
        self.assertEqual(self.createReaderCard(data), "Địa chỉ độc giả không hợp lệ!")
        time.sleep(10)
    
    # address only includes spaces 
    def test_8(self):
        data = {"name": "thuan", "dateOfBirth": "05-19-2001",
                "address": "   ", "email": "thuancoixy234786@gmail.com",
                "createDate": "06-01-2021"}
        self.createReaderCard(data)
        self.assertEqual(self.createReaderCard(data), "Địa chỉ độc giả không hợp lệ!")
        time.sleep(2)

    # age test
    # valid age
    def test_9(self):
        data = {"name": "thuan", "dateOfBirth": "05-19-2001",
                "address": "abc", "email": "thuancoixy234786@gmail.com",
                "createDate": "06-01-2021"}
        self.createReaderCard(data)
        self.assertEqual(self.createReaderCard(data), "Tạo thẻ độc giả thành công!")
        time.sleep(2)

    # invalid age
    def test_10(self):
        data = {"name": "thuan", "dateOfBirth": "06-01-2021",
                "address": "abc", "email": "thuancoixy234786@gmail.com",
                "createDate": "06-01-2021"}
        self.createReaderCard(data)
        self.assertEqual(self.createReaderCard(data), "Độ tuổi không đúng với quy định!")
        time.sleep(2)
    
    def tearDown(self):
        self.driver.close()
        

if __name__ == "__main__":
    unittest.main()