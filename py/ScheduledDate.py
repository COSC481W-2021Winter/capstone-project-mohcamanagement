class ScheduledDate:
	def __init__(self, cursor):
		self.shifts = list()
		self.startTime = list()
		self.endTime = list()

		cursor.execute('SELECT * FROM shifttimes')

		data = cursor.fetchall()


		self.shiftAmount = len(data)

		for i in range(len(data)):
			self.shifts.append(data[i][0])
			self.startTime.append(data[i][1])
			self.endTime.append(data[i][2])


	def getStartTimeDictionary(self):
		startTimeDict = {self.shifts[i] : self.startTime[i] for i in range(len(self.startTime))}
		return startTimeDict

	def getEndTimeDictionary(self):
		endTimeDict = {self.shifts[i] : self.endTime[i] for i in range(len(self.endTime))}
		return endTimeDict
