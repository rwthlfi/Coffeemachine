from flask import Flask, render_template, request
import RPi.GPIO as GPIO
import time

GPIO.cleanup()

app = Flask(__name__)

pins = [12, 1, 7, 13, 20, 16, 21]

for pin in pins:
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(pin, GPIO.OUT)
    GPIO.output(pin, GPIO.LOW)

def get_len(lst):
    return len(lst)


def pin_anschalten(id):
    GPIO.output(pins[id - 1], GPIO.HIGH)  
    time.sleep(0.3)  
    GPIO.output(pins[id - 1], GPIO.LOW) 

@app.route('/')
def index():
    return render_template('index.html', pins=pins, get_len=get_len)  

@app.route('/toggle/<int:id>', methods=['GET', 'POST'])
def toggle(id):
    if request.method == 'POST':
        pin_anschalten(id)
    return render_template('index.html', pins=pins, get_len=get_len)  

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=8080)
