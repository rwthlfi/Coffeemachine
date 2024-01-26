import smbus
import time

# ADS7830 I2C-Adresse
ADC_ADDRESS = 0x4b

# Erstelle ein SMBus-Objekt
bus = smbus.SMBus(1)

def read_led_state():
    # Wähle den ADC-Kanal A0 (Kanal 0)
    channel = 0

    # Sende das Befehlswort zum Lesen des ADC-Werts für den ausgewählten Kanal
    command = 0x84 | (channel << 4)
    value = bus.read_word_data(ADC_ADDRESS, command)

    # Tausche die Bytes und berechne die tatsächliche Spannung (0-4.096V)
    voltage = ((value & 0xFF) << 4) | ((value & 0xF00) >> 8)
    voltage = voltage * 4.096 / 4095.0

    # Wenn die gemessene Spannung über 0,8 V liegt, ist die LED eingeschaltet
    if voltage >= 0.8:
        return True
    else:
        return False

def main():
    try:
        while True:
            led_state = read_led_state()
            if led_state:
                print("LED ist eingeschaltet")
            else:
                print("LED ist ausgeschaltet")
            time.sleep(1)  # Führe die Abfrage alle 1 Sekunde erneut aus.
    except KeyboardInterrupt:
        pass

if __name__ == '__main__':
    main()
