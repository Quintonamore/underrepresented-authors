import requests
from bs4 import BeautifulSoup
import pyodbc

print("----------------------------------------------------------")

conn = pyodbc.connect(driver='{MySQL ODBC 8.0 ANSI Driver}',
                        server='34.82.68.145:3306',
                        database='bipoc_authors',
                        uid='root',pwd='underrepresented-authors-5441-hi-mom')

sessions_requests = requests.Session()
login_url = "https://www.goodreads.com/user/sign_in"
result = sessions_requests.get(login_url)

cookies = {
    'ccsid': '606-5930128-5258503',
    '__qca': 'P0-177322303-1623567855151',
    '__gads': 'ID=906d1764ab9ae866:T=1624687056:S=ALNI_MakX9Bo1u_2RI_mADEErp7coChP8Q',
    'likely_has_account': 'true',
    'allow_behavioral_targeting': 'true',
    'locale': 'en',
    'p': 'TIEDZmODNTXUMt9rGW5j47l9VAgIW2KozyWtNRk_zc7iZGzd',
    'blocking_sign_in_interstitial': 'true',
    'u': 'RXlzIGPeTTsf-AjYmP3sfPP0x37SJiq2szlW5Dr0a_pjkWIz',
    '_session_id2': '08c83a2a27583d5c2650d89c10c4176d',
}

headers = {
    'Connection': 'keep-alive',
    'Cache-Control': 'max-age=0',
    'sec-ch-ua': '^\\^',
    'sec-ch-ua-mobile': '?0',
    'Upgrade-Insecure-Requests': '1',
    'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
    'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Sec-Fetch-Site': 'none',
    'Sec-Fetch-Mode': 'navigate',
    'Sec-Fetch-User': '?1',
    'Sec-Fetch-Dest': 'document',
    'Accept-Language': 'en-US,en;q=0.9',
    'If-None-Match': 'W/^\\^ddae222cb1f6b5cd8483b421666e740e^\\^',
}

#NB. Original query string below. It seems impossible to parse and
#reproduce query strings 100% accurately so the one below is given
#in case the reproduced version is not "correct".
# response = requests.get('https://www.goodreads.com/shelf/show/bipoc?page=3', headers=headers, cookies=cookies)

for page in range(1,2):
  print(str(page))
  # BIPOC LINK: https://www.goodreads.com/shelf/show/bipoc?page=
  # LGBT LINK: https://www.goodreads.com/shelf/show/lgbt?page=
  # NEURODIVERGENT LINK: https://www.goodreads.com/shelf/show/neurodivergent?page=
  # ACTIVISM: https://www.goodreads.com/shelf/show/activism?page=
  # SOCIAL JUSTICE: https://www.goodreads.com/shelf/show/social-justice?page=


  response = requests.get('https://www.goodreads.com/shelf/show/bipoc?page=' + str(page), headers=headers,  cookies=cookies)

  # CHANGE THESE FOR EACH SHELF
  theme = "BIPOC"
  authID = "N/A"
  soup = BeautifulSoup(response.text, 'html.parser')
  all_books = soup.find(class_ ="leftContainer")
  books = all_books.find_all(class_="elementList")

  for x in books:
    # Extracts title and author
    title = x.find(class_="bookTitle").get_text()
    author = x.find(class_="authorName").get_text()

    # Go into each book information link
    info_link = x.find(class_="bookTitle").get('href')
    response = requests.get('https://www.goodreads.com'+ info_link)
    newSoup = BeautifulSoup(response.text, 'html.parser')

    # title = newSoup.find(id ="bookTitle").get_text().strip()
    # author = newSoup.find(class_="authorName").get_text()
    # print(info_link)
    # print(title)
    # print(author)

    # Extracts number of pages
    numPages = newSoup.find(itemprop ="numberOfPages").get_text().split(" ")
    numPages = numPages[0]
    # print(numPages)
    if int(numPages) > 200:
      length = "novel"
    elif int(numPages) > 5:
      length = "short story"
    else:
      length = "poem"

    # Extracts publishing date
    pubDate = newSoup.find(id ="details").get_text().split("\n")
    pubDate = pubDate[4].strip()
    pubYear = pubDate.split(" ")
    pubYear = pubYear[2]
    # print(pubYear)

    # Extracts ISBN
    isbn = newSoup.find_all(class_="infoBoxRowItem")
    isbn = isbn[1].get_text().strip().split(" ")
    isbn = isbn[0].strip()
    # Check if ISBN is a number
    if not isbn.isdecimal():
      isbn = "Unknown"
    # print(isbn)

    # Extracts ISBN13
    isbn13 = newSoup.find_all(class_="infoBoxRowItem")
    isbn13 = isbn13[1].get_text().strip().split(" ")
    isbn13 = isbn13[len(isbn13) - 1]
    isbn13 = isbn13.replace(")", "")
    # Check if ISBN is a number
    if not isbn13.isdecimal():
      isbn13 = 12345
    print(isbn13)

    # Extracts book description
    description = newSoup.find_all(id = "description")
    description = description[0].text
    description = description.split("\n")
    description = description[2]
    # description = isbn[1].get_text().strip().split(" ")
    # print(description)

    # Extracts genres
    genres = []
    genre_list = newSoup.find_all(class_="actionLinkLite bookPageGenreLink")
    for genre in genre_list:
      genres.append(genre.text)
    divider = ", "
    genres = divider.join(genres)
    # print(genres)

    # Extracts cover image

    cover_container = newSoup.find(class_ = "bookCoverPrimary")
    cover = cover_container.find('img')
    cover_link = cover.attrs['src']
    # print(cover_link)
    # print("\n")
    full_link = 'https://www.goodreads.com' + info_link
    # Creates data variable
    print("----------------------------------------------------------")
    # data = author + ", " + title + ", " + pubDate + ", " + genres + ", " + theme + ", " + authID + ", " + length + ", " + isbn13 + ", " + "0.0, " + cover_link + ", " + description + ", " + info_link
    sql = """INSERT INTO books_authors(AuthName, BookTitle, Year, Genre, Theme, AuthIdent, Length, ISBN, Approval, bookcover, description, Link) VALUES('{}', '{}', {}, '{}', '{}', '{}', '{}', {}, 0.0, '{}', '{}', '{}')""".format(author, title, pubYear, genres, theme, authID, length, isbn13, cover_link, description, full_link)
    print(sql)
    print("----------------------------------------------------------")
    cursor = conn.cursor()
    print("----------------------------------------------------------")
    try:
        cursor.execute(sql)
        cursor.execute('SELECT * FROM bipoc_authors.books_authors')

        for row in cursor:
            print(row)
        conn.commit()
    except:
        conn.rollback()
        print("Didn't work")
    print("----------------------------------------------------------")






# sql = """INSERT INTO books_authors(AuthName, BookTitle, Year, Genre, Theme, AuthIdent, Length, ISBN, Approval, bookcover, description, Link) VALUES(data)"""

