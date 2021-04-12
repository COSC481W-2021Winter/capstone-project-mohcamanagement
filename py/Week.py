from Day import *
import mysql.connector
#import traceback
class Week:
    def __init__(self, scheduleInfo):
        self.currentWeek = [Day(scheduleInfo),
                            Day(scheduleInfo),
                            Day(scheduleInfo),
                            Day(scheduleInfo),
                            Day(scheduleInfo),
                            Day(scheduleInfo),
                            Day(scheduleInfo)]
        
    #Gets the day given by a integer index

    def getNewDay(self, dayIndex):
        #traceback.print_stack()
        #for line in traceback.format_stack():
         #   print(line.strip())
        return self.currentWeek[dayIndex]

    def getDay(self, dayIndex):
        #traceback.print_stack()
        #for line in traceback.format_stack():
         #   print(line.strip())
        return self.currentWeek[dayIndex]

    def getUserNameFromPin(self, pin, userList):
        for user in userList:
            if user.getUserID() == pin:
                return user.getName()
        return None

    #Converts the entire week to a string
    def weekToString(self, userList):
        #For all 7 days in a week, first get the day
        for i in range(0, 7):
            currentDay = self.getDay(i)
            shiftAmount = currentDay.getShiftAmount()
            shifts = currentDay.getShift()
            for j in range(0, shiftAmount-1):
                if(shifts[j] != 0):
                    userName = self.getUserNameFromPin(shifts[j], userList)
                    if userName != None: print(self.getWeekDay(i) + " Shift: " + str(j+1) + ": " + userName)
                else: print(self.getWeekDay(i) + " Shift: " + str(j+1) + ": Off")
            print("\n")

    def writeScheduleToDatabase(self, userList):

        overseer = mysql.connector.connect(
		host="localhost",
		user="root",
		password="",
		database="overseer")


        cur = overseer.cursor(buffered=True)

        cur.execute("DELETE FROM `workingschedule`")


        #For all 7 days in a week, first get the day
        for user in userList:
            currentWeek = user.getWeek()
            scheduleTemp = [-1] * 7
            for i in range(0,7):
                shiftIndex = currentWeek.getDay(i).getShiftSet()
                if shiftIndex != -1: scheduleTemp[i] = shiftIndex
            cur.execute("INSERT INTO `workingschedule`(`Username`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`, `Sunday`) VALUES ('"+user.getName()+"', '"+self.getShiftString(scheduleTemp[0])+"', '"+self.getShiftString(scheduleTemp[1])+"', '"+self.getShiftString(scheduleTemp[2])+"', '"+self.getShiftString(scheduleTemp[3])+"', '"+self.getShiftString(scheduleTemp[4])+"', '"+self.getShiftString(scheduleTemp[5])+"', '"+self.getShiftString(scheduleTemp[6])+"')")

        overseer.commit()
        cur.close()

    def printWeekMatrix(self):
        for i in range(0, 7):
            currentDay = self.getDay(i)
            print(currentDay.getShift())
        print("\n")

    def getWeekDay(self, day):
        days = {
            0: "Monday",
            1: "Tuesday",
            2: "Wednesday",
            3: "Thursday",
            4: "Friday",
            5: "Saturday",
            6: "Sunday",
        }
        #Returns either the day, or "Incorrect Input"
        #If the input is not one of the 0-6 days
        return days.get(day, "Incorrect Input")


    def getShiftString(self, shift):
        shifts = {
            -1: "Off",
            0: "1st",
            1: "2nd",
            2: "3rd",
            3: "Off",
        }
        #Returns either the day, or "Incorrect Input"
        #If the input is not one of the 0-6 days
        return shifts.get(shift, "Incorrect Input")