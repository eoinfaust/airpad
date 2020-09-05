#include <TH02_dev.h>
#include "Arduino.h"
#include "Wire.h"
// Hardware: Grove - Sound Sensor, Grove - LED
/*macro definitions of the sound sensor and the LED*/
#define SOUND_SENSOR A0
#define SOUND_THRESHOLD_VALUE 50//The threshold to turn the led on 400.00*5/1024 = 1.95v
void setup(){
  Serial.begin(9600);
  TH02.begin();
  delay(100);
  pins_init();
}
unsigned long previousMillis = 0;
void loop(){
  unsigned long currentMillis = millis();
  int soundSensorValue = 0;//use A0 to read the sound level signal
  int soundSensorValueTemp = 0;
  while(4500 >= (currentMillis - previousMillis)){
    soundSensorValueTemp = analogRead(SOUND_SENSOR);//use A0 to read the sound level signal
    if(soundSensorValueTemp > soundSensorValue){
      soundSensorValue = soundSensorValueTemp;
    }
    currentMillis = millis();
  }
  Serial.print("Sound level: ");
  Serial.print(soundSensorValue);
  Serial.println(" dB.\r\n" );
  
  float temper = TH02.ReadTemperature();
  Serial.print("Temperature: ");
  Serial.print(temper);
  Serial.println("C.\r\n");

  float humidity = TH02.ReadHumidity();
  Serial.print("Humidity: ");
  Serial.print(humidity);
  Serial.println("%.\r\n");
  currentMillis = millis();
  delay(5000-(currentMillis-previousMillis)); //print again
  previousMillis = millis();
}
void pins_init(){
  pinMode(LED_BUILTIN, OUTPUT);
  pinMode(SOUND_SENSOR, INPUT);
}
void turnOnLED(){
  digitalWrite(LED_BUILTIN,HIGH);
}
void turnOffLED(){
  digitalWrite(LED_BUILTIN,LOW);
}
