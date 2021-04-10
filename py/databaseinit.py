import mysql.connector

counter = 0

def parseSQLStatements(filename):
    try:
        sqlFile = open(filename, 'rt')
        sqlStatements = sqlFile.read()
        sqlFile.close()
        return sqlStatements
    except:
        print("Error opening file, closing program!")
        return None
        
    
def getStatementList(queryStrings):
    accumulator = ""
    queries = list()
    for character in queryStrings:
        accumulator += character
        if character == ';':
            queries.append(accumulator)
            accumulator = ""
    return queries

def resetDatabase():
    overseer = mysql.connector.connect(
    host="localhost",
    user="root",
    password="")

    cur = overseer.cursor()

    cur.execute("DROP DATABASE IF EXISTS overseer;")

    cur.execute("CREATE DATABASE Overseer;")

    cur.close()

def executeQueries(cursor, statements):
    global counter
    for i in statements:
        print(i)
        cursor.execute(i)
        counter+= 1

def main():
    resetDatabase()

    overseer = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="overseer")

    cur = overseer.cursor()

    ddl = parseSQLStatements("DDL.txt")
    dml = parseSQLStatements("DML.txt")

    if ddl == None: return
    if dml == None: return

    statements = getStatementList(ddl)
    executeQueries(cur, statements)
    statements = getStatementList(dml)
    executeQueries(cur, statements)
    
    overseer.commit()

    print("A total of: "  +str(counter) + " queries executed")

    cur.close()
    
if __name__ == "__main__":
	main()