from gpiozero import DigitalInputDevice
import RPi.GPIO as GPIO
import time

LED_GPIO_PIN_1 = 6 #31
LED_GPIO_PIN_2 = 18 #12
LED_GPIO_PIN_3 = 24 #18
LED_GPIO_PIN_4 = 5 #29 
LED_GPIO_PIN_5 = 15 #10
LED_GPIO_PIN_6 = 14 #8
LED_GPIO_PIN_7 = 19 #35
LED_GPIO_PIN_8 = 0 #27
LED_GPIO_PIN_9 = 17 #11

GPIO.setmode(GPIO.BCM)
GPIO.setup(LED_GPIO_PIN_1, GPIO.IN)
GPIO.setup(LED_GPIO_PIN_2, GPIO.IN)
GPIO.setup(LED_GPIO_PIN_3, GPIO.IN)
GPIO.setup(LED_GPIO_PIN_4, GPIO.IN)
GPIO.setup(LED_GPIO_PIN_5, GPIO.IN)
GPIO.setup(LED_GPIO_PIN_6, GPIO.IN)
GPIO.setup(LED_GPIO_PIN_7, GPIO.IN)
GPIO.setup(LED_GPIO_PIN_8, GPIO.IN)
GPIO.setup(LED_GPIO_PIN_9, GPIO.IN)

previous_states = {
    LED_GPIO_PIN_1: False,
    LED_GPIO_PIN_2: False,
    LED_GPIO_PIN_3: False,
    LED_GPIO_PIN_4: False,
    LED_GPIO_PIN_5: False,
    LED_GPIO_PIN_6: False,
    LED_GPIO_PIN_7: False,
    LED_GPIO_PIN_8: False,
    LED_GPIO_PIN_9: False
}

def is_blinking(pin, interval, num_changes):
    changes = 0
    previous_state = GPIO.input(pin)
    start_time = time.time()

    while changes < num_changes:
        current_state = GPIO.input(pin)
        if current_state != previous_state:
            changes += 1
            previous_state = current_state
        if time.time() - start_time > interval:
            break

    return changes >= num_changes

try:
    while True:
        combination_triggered = False
        if is_blinking(LED_GPIO_PIN_6, 2, 2) and not previous_states[LED_GPIO_PIN_7] and not GPIO.input(LED_GPIO_PIN_7) and is_blinking(LED_GPIO_PIN_9, 2, 2): 
            print("Der Mahlgrad ist zu fein, sodass der Kaffee zu langsam oder gar nicht herausläuft.")
            combination_triggered = True
        if is_blinking(LED_GPIO_PIN_6, 2, 2) and not GPIO.input(LED_GPIO_PIN_9) and GPIO.input(LED_GPIO_PIN_7):
            print("Es wurde die Funktion „vorgemahlener Kaffee“ gewählt, aber das vorgemahlene Kaffeepulver wurde nicht eingefüllt")
            combination_triggered = True
        if is_blinking(LED_GPIO_PIN_6, 2, 2) and is_blinking(LED_GPIO_PIN_9, 2, 2) and GPIO.input(LED_GPIO_PIN_7):
            print("Es wurde zu viel Kaffee verwendet.")
            combination_triggered = True
        if not previous_states[LED_GPIO_PIN_6] and not GPIO.input(LED_GPIO_PIN_6) and is_blinking(LED_GPIO_PIN_9, 2, 2):
            print("Es sind keine Kaffeebohnen mehr im Behälter/ Der Einfüllschacht für den vorgemahlenen Kaffee ist verstopft.")
            combination_triggered = True
            
        if not combination_triggered:
            if is_blinking(LED_GPIO_PIN_1, 2, 2):
                print("Maschine wird aufgewärmt.")
            if not GPIO.input(LED_GPIO_PIN_2):
                print("Das Gerät gibt 1 oder 2 Tassen Espresso aus.")
            if not GPIO.input(LED_GPIO_PIN_3):
                print("Das Gerät gibt 1 oder 2 große Tassen Kaffee aus.")
            if not previous_states[LED_GPIO_PIN_4] and not GPIO.input(LED_GPIO_PIN_4):
                print("Die Funktion „Dampf“ wurde ausgewählt;")
            if is_blinking(LED_GPIO_PIN_4, 2, 2):
                print("Der Dampfdrehknopf muss gedreht werden.")
            if not previous_states[LED_GPIO_PIN_5] and not GPIO.input(LED_GPIO_PIN_5):
                print("Das Gerät führt gerade die Entkalkung durch") 
            if is_blinking(LED_GPIO_PIN_5, 2, 2):
                print("Das Gerät muss entkalkt werden.")   
            if not previous_states[LED_GPIO_PIN_6] and not GPIO.input(LED_GPIO_PIN_6):
                print("Der Kaffesatzbehälter fehlt: Kaffesatzbehälter einsetzen") 
            if is_blinking(LED_GPIO_PIN_6, 2, 2):
                print("Der Kaffeesatzbehälter ist voll und muss geleert werden.")   
            if not previous_states[LED_GPIO_PIN_7] and not GPIO.input(LED_GPIO_PIN_7):
                print("Der Wassertank fehlt.") 
            if is_blinking(LED_GPIO_PIN_7, 2, 2):
                print("Das Wasser im Tank ist nicht ausreichend.") 
            if not GPIO.input(LED_GPIO_PIN_8):
                print("Energiesparmodus ist aktiv")     
            if not previous_states[LED_GPIO_PIN_9] and not GPIO.input(LED_GPIO_PIN_9):
                print("Das Maschineninnere ist sehr verschmutzt.") 
            if is_blinking(LED_GPIO_PIN_9, 2, 2):
                print("Die Brüheinheit wurde nach der Reinigung nicht wieder eingesetzt.") 
        
        for pin in previous_states:
            previous_states[pin] = GPIO.input(pin)
        
        time.sleep(1)

except KeyboardInterrupt:
    print("Programm beendet")
finally:
    GPIO.cleanup()
