# Bibliotheken laden
from gpiozero import Button

# Initialisierung von GPIO27 als Button (Eingang)
button = Button(27)

# Wiederholung einleiten
while True:
    # Wenn Button gedrückt wurde
    if button.is_pressed:
        # Text-Ausgabe
        print("Taster wurde gedrückt")