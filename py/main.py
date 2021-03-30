import sqlite3
from ScheduledDate import *

def main():
	con = sqlite3.connect('overseer.db')
	cur = con.cursor()
	
	date = ScheduledDate(cur)

	dict = date.getEndTimeDictionary()

	testStart = dict.get("1st", "invalid")

	print(str(testStart))


	con.close()


if __name__ == "__main__":
	main()