from time import sleep
from Adafruit_CharLCD import Adafruit_CharLCD

# instantiate lcd and specify pins
lcd = Adafruit_CharLCD(rs=24, en=23,
                       d4=22, d5=27, d6=17, d7=18,
                       cols=16, lines=2)
lcd.clear()
# display text on LCD display \n = new line
lcd.message('Geef uw code in:')
