from Week import *
from functools import cmp_to_key
class Schedule:
    def __init__(self, userList, scheduleInfo):
        self.userList = userList
        self.finalizedWeek = Week(scheduleInfo)
        self.scheduleInfo = scheduleInfo

    def sortUserArray(self):
        self.userList.sort(key=cmp_to_key(self.compareByWeight), reverse=True)
	
    def compareByWeight(self, a, b):
        if (a.getUserWeight() < b.getUserWeight()):
            return -1
        if (a.getUserWeight() > b.getUserWeight()):
            return 1
        return 0

    #Prints the schedule
    def printSchedule(self):
        self.finalizedWeek.weekToString(self.userList)
        #for j in range(0, 6):
        #    print(self.finalizedWeek.weekToString())

    #Assigns a user to a shift
    def assignUserToShift(self, dayIndex, shiftIndex, userID):
        #if user.getHoursAssigned >= user.getRequestedhours
            #remove them

        #if (user.getHoursAssigned() >= user.getRequestedhours()):
            #self.userList.pop()
        self.finalizedWeek.getDay(dayIndex).setShiftID(shiftIndex, userID)

    #In case of backtrack purposes
    def removeUserFromShift(self):
        self.finalizedWeek.getDay(dayIndex).removeShiftInt(shiftIndex)

    #Judges a user's request to work that day
    def judgeUserRequest(self, dayIndex):
        currentDay = self.finalizedWeek.getDay(dayIndex)            #Set current day to the day index passed as parameter
        currentUser=0                                               #Instantiate current user
        shifts = currentDay.getShift()                              #Get list of shits from current day
        for shiftIndex in range(0, len(shifts)-1):                  #Loop through each shift for that day
            for user in self.userList:                              #Loop through each user to check if they are available for that shift
                #print("Day: " + str(dayIndex) + "\nShift: " + str(shiftIndex))
                if(user.isAvailable(dayIndex, shiftIndex)):         #If user is available for that shift, then assign them to that shift
                    self.assignUserToShift(dayIndex, shiftIndex, user.getUserID())    #
                    user.assignHours(shiftIndex)                    #
                    user.calculateUserWeight()                      #
                    if(user.getUserWeight()<=0): self.userList.remove(user)
                    self.sortUserArray()                            #
                    break                                           #
        #daysAvailable = user.calculateDaysWorking()     #How many days a user is available
        #userAvailability = user.getUserAvailability()   #User's requested availability
        #currentDay = finalizedWeek.getDay(dayIndex)     #Current day of schedule week
        #shifts = userAvailability[dayIndex]             #User's requested shift

    #Determine if all userList have a shift or if all days are set
    def stillAvailable(self):
        return True #Should not always return True
        
    #Creates the week schedule
    def createSchedule(self):
        for dayIndex in range(0,7):
            self.judgeUserRequest(dayIndex)