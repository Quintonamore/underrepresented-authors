from bs4 import BeautifulSoup
import requests
from selenium import webdriver
from selenium.common.exceptions import WebDriverException
import time

import pyodbc

print("----------------------------------------------------------")
count = 100
conn = pyodbc.connect(driver='{MySQL ODBC 8.0 ANSI Driver}',
                      server='34.82.68.145:3306',
                      database='bipoc_authors',
                      uid='root', pwd='underrepresented-authors-5441-hi-mom')

driver = webdriver.Chrome('./chromedriver')
driver.maximize_window()
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
while i < 25:
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
    try:
        pubDate = info[2].get_text()
        pubYear = pubDate.split(" ")
        pubYear = pubYear[2]
        print(pubYear)
    except:
        pubYear = "Unknown"
    theme = "BIPOC"
    authID = "N/A"

    # Go into each book link
    info_link = x.find(class_="_6lnTT").get('href')
    # urllib.parse.quote(info_link, safe='/', encoding = None, errors = None)
    response = requests.get(info_link)
    newSoup = BeautifulSoup(response.text, 'html.parser')
    # print(info_link)
    # print(response)

    try:
        genres = newSoup.find(id="comp-k7atug3i").get_text()
        print(genres)
        description = newSoup.find(id="comp-k68debhj").get_text()
        print(description)
    except:
        genres = "Not found"
        description = "Not found"
        print("Incorrect Book Info link")

    try:
        # Go into each book shop link
        bookshop_link = x.find_all(class_="_6lnTT")
        bookshop_link = bookshop_link[1].get("href")
        response = requests.get(bookshop_link)
        bookShopSoup = BeautifulSoup(response.text, 'html.parser')

        numPages = bookShopSoup.find(itemprop="numberOfPages").get_text()
        print(numPages)
        if int(numPages) > 200:
            length = "novel"
        elif int(numPages) < 5:
            length = "poem"
        isbn13 = bookShopSoup.find(itemprop="isbn").get_text()
        print(isbn13)
        cover_container = bookShopSoup.find(class_="block w-full")
        cover = cover_container.find('img')
        cover_link = cover.attrs['src']
        print(cover_link)
    except:
        isbn13 = "Not found"
        cover_link = "Not found"
        length = "Not found"
        print("No Bookshop Link")

    print("\n")

    sql = """INSERT INTO books_authors(AuthName, BookTitle, Year, Genre, Theme, AuthIdent, Length, ISBN, Approval, bookcover, description, Link) VALUES('{}', '{}', {}, '{}', '{}', '{}', '{}', {}, 0.0,'{}', '{}', '{}')""".format(
        author, title, pubYear, genres, theme, authID, length, isbn13, cover_link, description, info_link)

    print(sql)

    print("\n")
    cursor = conn.cursor()
    try:
        cursor.execute(sql)
        cursor.execute('SELECT * FROM bipoc_authors.books_authors')

        for row in cursor:
            print(row)

    except Exception as e:
        conn.rollback()
        print(e)

        cursor.execute('SELECT * FROM bipoc_authors.books_authors')

        for row in cursor:
            print(row)
    print("\n")
conn.commit()
driver.quit()