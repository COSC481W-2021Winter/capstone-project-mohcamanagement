import mysql.connector
from User import *
from Schedule import *
from functools import cmp_to_key

#Programmed by Marvin Zavala, Dimitri Aguilar, and Joshua Kuiper

def main():
	overseer = mysql.connector.connect(
		host="localhost",
		user="root",
		password="",
		database="overseer")


	cur = overseer.cursor(buffered=True)
	
	date = ScheduledDate(cur)

	cur.execute("SELECT * FROM users")


	userList = list()

	userRows = cur.fetchall()
	for userData in userRows:

		if userData[2] == 0:
			currentUser = User(userData, cur, date)
			if currentUser.calculateDaysWorking() != 0:
				userList.append(currentUser)

	overseer.close()

	userList.sort(key=cmp_to_key(compareByWeight), reverse=True)

	workSchedule = Schedule(userList, date)
	workSchedule.createSchedule()
	workSchedule.printSchedule()

	print("Done")

	

    
def sortUserArray(userArray):
	userArray.sort(key=cmp_to_key(compareByWeight), reverse=True)
	
def compareByWeight(a, b):
    if (a.getUserWeight() < b.getUserWeight()):
        return -1
    if (a.getUserWeight() > b.getUserWeight()):
        return 1
    return 0
    

if __name__ == "__main__":
	main()