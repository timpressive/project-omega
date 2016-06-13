#!/usr/bin/python2.7

import RPi.GPIO as GPIO
from time import sleep
from Adafruit_CharLCD import Adafruit_CharLCD

GPIO.setmode(GPIO.BCM)
lcd = Adafruit_CharLCD(rs=21, en=20,
                       d4=6, d5=13, d6=19, d7=26,
                       cols=16, lines=2)

header = "Geef pincode in:\n"

lcd.clear()
lcd.message(header)

lcd.set_cursor(5,1)

MATRIX = [ ["1","2","3"],
	   ["4","5","6"],
	   ["7","8","9"],
	   ["*","0","#"] ]

ROW = [6,13,19,26]
COL = [16,20,21]

code = ""
pin = "6319"

def getCode():
	global code

	for j in range (3):
		GPIO.setup(COL[j], GPIO.OUT)
		GPIO.output(COL[j], 1)
	
	for i in range(4):
		GPIO.setup(ROW[i], GPIO.IN, pull_up_down = GPIO.PUD_UP)

	try:
		while(True):
			for j in range(3):
				GPIO.output(COL[j],0)
				
				for i in range(4):
					if GPIO.input(ROW[i]) == 0:
						if MATRIX[i][j] == '#':
							code = ''
							lcd.clear()
							lcd.message(header)
							lcd.set_cursor(5,1)
						else:
							code = code + MATRIX[i][j]
							lcd.message(MATRIX[i][j] + " ")
	
						if len(code) == 4:
							if code == pin:
								lcd.set_cursor(4,1)
								lcd.message("Correct!")
								sleep(1.0)
								lcd.clear()
								lcd.set_backlight(0)

								print "Correct!"
								return "correct!"
							else:
								code = ""
								lcd.clear()
								lcd.set_cursor(3,0)
								lcd.message("Incorrect!")

								sleep(2.0)
								
								lcd.clear()
								lcd.message(header)
								lcd.set_cursor(5,1)
						while(GPIO.input(ROW[i]) == 0):
							pass

				GPIO.output(COL[j], 1)
	except KeyboardInterrupt:
		GPIO.cleanup()

getCode()
