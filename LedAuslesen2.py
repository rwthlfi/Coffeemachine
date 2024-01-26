import RPi.GPIO as GPIO
import time

# Setze die verwendeten GPIO-Pins hier entsprechend deiner Verkabelung
led_pins = [26, 18, 23]  # Beispiel: GPIO18, GPIO23, GPIO24

# Konfiguriere die GPIO-Bibliothek
GPIO.setmode(GPIO.BCM)
GPIO.setup(led_pins, GPIO.OUT)

def read_leds_status():
    # Lies den Status der LEDs und gib ihn zurück.
    leds_status = [GPIO.input(pin) for pin in led_pins]
    return leds_status

def interpret_leds_status(status):
    # Hier kannst du den Status der LEDs interpretieren und den Zustand der Kaffeemaschine ableiten.
    # Implementiere entsprechende Logik, um den Zustand zu erkennen und auszugeben.
    if status == [0, 0, 0]:
        return "Kaffeemaschine ist ausgeschaltet"
    elif status == [1, 0, 0]:
        return "Kaffeemaschine ist betriebsbereit"
    elif status == [0, 1, 0]:
        return "Kaffeemaschine brüht"
    elif status == [0, 0, 1]:
        return "Kaffeemaschine ist fertig"
    else:
        return "Unbekannter Zustand"

try:
    while True:
        leds_status = read_leds_status()
        coffee_machine_status = interpret_leds_status(leds_status)
        print("Status der Kaffeemaschine:", coffee_machine_status)
        time.sleep(1)

except KeyboardInterrupt:
    # Beim Abbrechen des Programms (z.B. durch Strg+C) GPIO sauber aufräumen
    GPIO.cleanup()
