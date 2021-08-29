#This program connects to the database and allows you to view the data set and delete based on manually inputted information before running
import pyodbc

conn = pyodbc.connect(driver='{MySQL ODBC 8.0 ANSI Driver}',
                        server='34.82.68.145:3306',
                        database='bipoc_authors',
                        uid='root',pwd='underrepresented-authors-5441-hi-mom')
cursor = conn.cursor()

running = True

while running:
    print("Here is the current data set")
    cursor.execute('SELECT * FROM bipoc_authors.books_authors')
    for row in cursor:
        print(row)

    print("List of variables: AuthName, BookTitle, Year, Genre, Theme, AuthIdent, Length, ISBN, Approval, bookcover, description, Link")
    var = input("Which do you want to delete by?:")
    data = input("what is the data?:")

    sql = "DELETE FROM books_authors WHERE {}='{}'".format(var, data)

    try:
        cursor.execute(sql)
        cursor.execute('SELECT * FROM bipoc_authors.books_authors')

        for row in cursor:
            print(row)
        conn.commit()
    except Exception as e:
        conn.rollback()
        print(e)

        cursor.execute('SELECT * FROM bipoc_authors.books_authors')

        for row in cursor:
            print(row)

    answer = input("Would you like to delete another data entry? (Y or N): ")
    if answer.lower() == "n":
        running = False
