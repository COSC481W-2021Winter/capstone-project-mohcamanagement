class Day:
    def __init__(self, scheduleInfo):
        self.scheduleInfo = scheduleInfo
        self.shifts = [0] * self.scheduleInfo.getShiftAmount()
    
    def getShift(self):
        return self.shifts
        
    def setShift(self, shift):
        shiftIndex = self.scheduleInfo.shiftStringToIndex(shift)
        self.shifts[int(shiftIndex)] = 1
    
    def getShiftAmount(self):
        return len(self.shifts)

    def setShiftInt(self, passedIndex):
        self.shifts[passedIndex] = 1

    def setShiftID(self, passedIndex, userID):
        self.shifts[passedIndex] = userID

    def removeShift(self, shift):
        shiftIndex = self.scheduleInfo.shiftStringToIndex(shift)
        self.shifts[shiftIndex] = 0
    
    def removeShiftInt(self, shift):
        self.shifts[shift] = 0

    def getShiftSet(self):
        index = 0
        for i in self.shifts:
            if i == 1:
                return index
            index += 1
        return -1
