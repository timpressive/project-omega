import sys
import time

duration = int(sys.argv[1])
end = int(time.time() + duration)
def countdown():
	remaining = int(end - time.time())
	while remaining >= 0:
		hours = remaining / 3600
		minutes = (remaining - (hours * 3600)) / 60 
		seconds = (remaining - (hours * 3600)) % 60
		print "%d:%2d:%3d" % (hours,minutes,seconds)
		time.sleep(1.0)
		remaining = int(end - time.time())
		pass
	
	print "Virus verspreiden..."
	time.sleep(2.5)
	print "Apocalypse gestart"

countdown()
