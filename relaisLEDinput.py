import RPi.GPIO as GPIO

relais1 = 5

def setup():
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(relais1, GPIO.OUT)

def relais_on():
    GPIO.output(relais1, True)

def relais_off():
    GPIO.output(relais1, False)

def destroy():
    GPIO.cleanup()

if __name__ == '__main__':
    setup()
    try:
        while True:
            user_input = input("0 oder 1 eingeben um Relais an/auszuschalten: ")
            if user_input == '1':
                relais_on()
            elif user_input == '0':
                relais_off()
            else:
                print("ungültige Eingabe")
    except KeyboardInterrupt:
        destroy()
        
        