from bs4 import BeautifulSoup
import requests
from selenium import webdriver
from selenium.common.exceptions import WebDriverException
import time

print("----------------------------------------------------------")

# options = ChromeOptions()
# options.add_argument("--start-maximized")
driver = webdriver.Chrome('./chromedriver')
driver.maximize_window()
# driver = webdriver.Chrome(executable_path=chrome_path, options=option)
driver.implicitly_wait(10)
driver.get('https://www.bipocbookshelf.com/bipoc-bookshelf')
try:
  time.sleep(2)
  closeCookiesButton = driver.find_element_by_xpath('/html/body/div[2]/span/button/img')
  closeCookiesButton.click()
  driver.implicitly_wait(10)
  closePopUpButton = driver.find_element_by_xpath('//*[@id="comp-kq36m57s1"]/div')
  closePopUpButton.click()
except WebDriverException as e:
  print("Exiting didn't work")
  print(e)

i = 0
while i < 20:
  try:
    button = driver.find_element_by_xpath('//*[@id="comp-k5wr6lz5"]/button')
    # time.sleep(2)
    button.click()
    time.sleep(5)
    print("It worked!")
    i = i + 1
  except WebDriverException as e:
    print("Click didn't work")
    print(e)
    break

soup_file = driver.page_source
soup = BeautifulSoup(soup_file, 'html.parser')
# print(driver.find_element_by_id("comp-k5wr6lz5"))
# browser = webdriver.Chrome(executable_path=chrome_path, options=option)
# WebDriver driver = new ChromeDriver ()

# sessions_requests = requests.Session()
# url = "https://www.bipocbookshelf.com/bipoc-bookshelf"
# print(url)
# result = sessions_requests.get(url)
# print(result)
# soup = BeautifulSoup(result.text, 'html.parser')
all_books = soup.find(id="comp-k68effle")
books = all_books.find_all(class_="_1vNJf")

for x in books:
  # Extracts title and author
  info = x.find_all(class_="_1Q9if")
  title = info[0].get_text()
  print(title)
  author = info[1].get_text()
  print(author)
  pubDate = info[2].get_text()
  print(pubDate)
  
  # Go into each book link
  info_link = x.find(class_="_6lnTT").get('href')
  # urllib.parse.quote(info_link, safe='/', encoding = None, errors = None)
  response = requests.get(info_link)
  newSoup = BeautifulSoup(response.text, 'html.parser')
  # print(info_link)
  # print(response)
  
  try: 
    genres = newSoup.find(id = "comp-k7atug3i").get_text()
    print(genres)
    description = newSoup.find(id = "comp-k68debhj").get_text()
    print(description)
  except:
    print("Incorrect Book Info link")
  
  try:
    # Go into each book shop link
    bookshop_link = x.find_all(class_="_6lnTT")
    bookshop_link = bookshop_link[1].get("href")
    response = requests.get(bookshop_link)
    bookShopSoup = BeautifulSoup(response.text, 'html.parser')
    
    numPages = bookShopSoup.find(itemprop = "numberOfPages").get_text()
    print(numPages)
    isbn13 = bookShopSoup.find(itemprop = "isbn").get_text()
    print(isbn13)
    cover_container = bookShopSoup.find(class_ = "block w-full")
    cover = cover_container.find('img')
    cover_link = cover.attrs['src']
    print(cover_link)
  except:
    print("No Bookshop Link")
  
  print("\n")

driver.quit()