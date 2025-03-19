import RPi.GPIO as GPIO

from mfrc522 import SimpleMFRC522

#pins = [25, 9, 10, 11]

#GPIO.setmode(GPIO.BCM)
    # Set up each pin and set it to low
#for pin in pins:
#    GPIO.setup(pin, GPIO.OUT)
#    GPIO.output(pin, GPIO.LOW)



reader = SimpleMFRC522()
try:
        id, text = reader.read_no_block()
        if id:
                print(id)
                print(text)
finally:
        GPIO.cleanup()
        