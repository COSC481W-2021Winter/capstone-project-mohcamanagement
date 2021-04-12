from ScheduledDate import *
from datetime import datetime
from Week import *

class User:
	def __init__(self, user, cursor, scheduleInfo):
		self.userWeight = 0
		self.totalRequestedHours = 0
		self.maxHoursPerWeek = 168
		self.startDict = scheduleInfo.getStartTimeDictionary()
		self.endDict = scheduleInfo.getEndTimeDictionary()
		self.name = user[0]
		self.pin = user[1]
		self.hoursAssigned = 0

		self.week = Week(scheduleInfo)
		self.availabilityWeek = Week(scheduleInfo)

		self.userAvailability = {"Monday" : [None] * scheduleInfo.getShiftAmount(), 
							"Tuesday" : [None] * scheduleInfo.getShiftAmount(), 
							"Wednesday" : [None] * scheduleInfo.getShiftAmount(),
							"Thursday" : [None] * scheduleInfo.getShiftAmount(),
							"Friday" : [None] * scheduleInfo.getShiftAmount(),
							"Saturday" : [None] * scheduleInfo.getShiftAmount(),
							"Sunday" : [None] * scheduleInfo.getShiftAmount()}


		cursor.execute('SELECT Day, ShiftName FROM availability WHERE Pin = %s', (self.pin,))

		data = cursor.fetchall()
		

		for i in range(len(data)):
			if data[i][1] == None: self.userAvailability.get(data[i][0]).append("Off")
			else: 
				shiftIndex = scheduleInfo.shiftStringToIndex(data[i][1])
				
				self.userAvailability.get(data[i][0])[shiftIndex] = data[i][1]

		#WE HAVE CONFIRMED THAT THIS SPECIFIC SET OF CODE RIGHT HERE
		#IS THE PROBLEM!!!!
		for dayIndex in range(len(self.userAvailability)):
			for shiftIndex in range(len(list(self.userAvailability.values())[dayIndex])):
				
				if(list(self.userAvailability.values())[dayIndex][shiftIndex] != None):
					
					self.availabilityWeek.getDay(dayIndex).setShiftInt(shiftIndex)


		

		self.calculateUserWeight()
	def getUserID(self):
		return self.pin

	def setUserWeight(self, weight):
		self.userWeight = weight

	def userAvailabilityAdd(self, element):
		self.userAvailability.append(element)


	def calculateDaysWorking(self):
		daysAmount = 0
		for i in list(self.userAvailability.values()):
			if len(i) > 0: daysAmount += 1
		return daysAmount

	def calculateTotalHoursRequested(self):
		for i in range(len(self.userAvailability)):
			for j in range(len(list(self.userAvailability.values())[i])):
				shift = list(self.userAvailability.values())[i][j]
				if(shift != None):
					startTime = self.startDict.get(shift)
					endTime = self.endDict.get(shift)
					# startTime+=":00"
					# endTime+=":00"
					# FMT='%H:%M:%S'
					# self.totalRequestedHours += String(datetime.strptime(endTime,FMT) - datetime.strptime(startTime,FMT))
					startHours,startMinutes = startTime.split(':', 1)
					#Start hour: 6:30
					#Splits into 6 & 30
					endHours, endMinutes = endTime.split(':', 1)

					self.totalRequestedHours += int(endHours)-int(startHours)
					tMinutes = int(endMinutes)-int(startMinutes)
					if(tMinutes<0):
						self.totalRequestedHours-=0.5
					if(tMinutes>0):
						self.totalRequestedHours+=0.5

					# (totalHours)
					#print(endTime)
		#print("Total hours: " + str(self.totalRequestedHours))

	def getShiftLength(self, shift):
		startTime = self.startDict.get(shift)
		endTime = self.endDict.get(shift)

		startHours,startMinutes = startTime.split(':', 1)
		endHours, endMinutes = endTime.split(':', 1)

		tHours = int(endHours)-int(startHours)
		tMinutes = int(endMinutes)-int(startMinutes)

		return tHours, tMinutes

	def assignHours(self, shift, day):
		self.week.getDay(day).setShiftInt(shift)

		startTime = list(self.startDict.values())[shift]
		endTime = list(self.endDict.values())[shift]

		startHours,startMinutes = startTime.split(':', 1)
		endHours, endMinutes = endTime.split(':', 1)
		
		tMinutes = int(endMinutes)-int(startMinutes)
		self.hoursAssigned += int(endHours) - int(startHours)

		if(tMinutes<0):
			self.hoursAssigned-=0.5
		if(tMinutes>0):
			self.hoursAssigned+=0.5

	def getHoursAssigned(self):
		return self.hoursAssigned

	def calculateUserWeight(self):
		self.calculateTotalHoursRequested()
		#Weight = (M - R + M/R)(1-(T/R))
		#Weight = (maxHoursPerWeekWeek - RequestedHours + (maxHoursPerWeek/Requested)) * (1 - (TotalHoursCurrentlyAssigned/Requested))
		weight = (self.maxHoursPerWeek - self.totalRequestedHours + (self.maxHoursPerWeek/max(self.totalRequestedHours,1))) * (1 - (self.hoursAssigned/max(self.totalRequestedHours,1)))

		self.setUserWeight(weight)
		
		#print(self.userWeight)

	def getUserWeight(self):
		return self.userWeight

	def getName(self):
		return self.name

	def getUserAvailability(self):
		return list(self.userAvailability.values())
	#Returns if user is available on given day. Confirmed not p.
	def isAvailable(self, dayIndex, shiftIndex):
		return self.availabilityWeek.getDay(dayIndex).getShift()[shiftIndex] == 1

	def getUserRequestedHours(self):
		return self.totalRequestedHours

	def getWeek(self):
		return self.week
