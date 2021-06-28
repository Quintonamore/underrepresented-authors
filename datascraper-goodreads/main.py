import requests
from bs4 import BeautifulSoup
import numpy as np

print("----------------------------------------------------------")

data = {}
data['books'] = []
sessions_requests = requests.session()
login_url = "https://www.goodreads.com/user/sign_in"
# result = session_requests.get(login_url)
login = {
  "user[email]": "<USER_EMAIL>",
  "user[password]": "<PASSWORD>"
}

for page in range(1,25):
  print(str(page))
  req = requests.get("https://www.goodreads.com/shelf/show/bipoc?    page="+ str(page) + "")
  soup = BeautifulSoup(req.text, 'html.parser')
  all_books = soup.find(class_ ="leftContainer")
  books = all_books.find_all(class_="elementList")

  for x in books:
    title =x.find(class_="bookTitle").get_text()
    print(title)
    author = x.find(class_="authorName").get_text()
    print(author)
    data['books'].append({'title': title, 'author': author})
  
with open('data.txt', 'w') as f:
  print(data, file=f)