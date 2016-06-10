import sys
import time

duration = int(sys.argv[1])
duration = duration

def countdown(s):
	for t in range(s, -1, -1):
		hours = t / 3600
		minutes = (t - hours * 3600) / 60
		seconds = (t - hours * 3600) % 60
		print "%d:%2d:%3d" % (hours,minutes,seconds)
		time.sleep(1.0)
	print "Virus verspreiden..."
	time.sleep(2.5)
	print "Apocalypse gestart"

countdown(duration)
