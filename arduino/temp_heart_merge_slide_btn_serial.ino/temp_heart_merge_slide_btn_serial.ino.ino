#include <OneWire.h>
#include <DallasTemperature.h>

//switch
int sw_pin1 = 6;
int sw_pin2 = 7;

int val;
unsigned long int count_lp=0;
float value;

//heartbeat
unsigned int reading, wait_time = 15000, count = 0;
bool state = 0, lastState = 0, flag = 0;
unsigned long previousMillis = 0;
unsigned long currentMillis = 0;
unsigned long previousMillis_temp = 0;
unsigned long currentMillis_temp = 0;
const long interval = 15000;
int BPM = 0;

//temp
//the pin you connect the ds18b20 to
#define DS18B20 2

OneWire ourWire(DS18B20);
DallasTemperature sensors(&ourWire);

void setup() {
  Serial.begin(115200);
  sensors.begin();
  pinMode(A3, INPUT); //heartbeat
  pinMode(sw_pin1,INPUT);
  pinMode(sw_pin2,INPUT);
  pinMode(2,INPUT);
  
  
}
void loop() {
  // put your main code here, to run repeatedly:
  int sw1_read = digitalRead(sw_pin1);
  int sw2_read = digitalRead(sw_pin2);


  if (sw1_read == 1 && sw2_read == 0) {
    count_lp++;
    //Serial.println(count_lp);
    if(count_lp==1)
    {
      previousMillis = 0;
    }
    //hearbeat
    
    reading = analogRead(A3);
    //Serial.println(reading);
    if ( reading >= 210 )
    {
      state = 1;
      if (lastState != state)
      {
        count++;
        //Serial.println(count);
        //Serial.print("|");
       // Serial.print("Pulse");
       // Serial.print("|");
        //Serial.print(".");
      }
    }
    else {
      state = 0;
    }
    lastState = state;
    currentMillis = millis();
    if ( currentMillis - previousMillis >= interval ) {
      previousMillis = currentMillis;
      BPM = 4 * count;
      count = 0;
      //Serial.println();
      //Serial.println("BPM: "+String(BPM));
      String str = "B:"+String(BPM);
      Serial.write("B:");
      Serial.print(BPM);
      BPM = 0;
      //Serial.write(String(BPM));
      //Serial.println(BPM);
    }
    else {
      //Serial.println(currentMillis - previousMillis);
      
    }
  
  }
  else if (sw1_read == 0 && sw2_read == 1) {
    count_lp=0;
    //temperature
    BPM = 0;
    count = 0;
    previousMillis = millis();
    //Serial.print(digitalRead(2));
    //Serial.print(" Reading From Pin | ");
    sensors.requestTemperatures();
    float c = sensors.getTempCByIndex(0);
    float f = ((c / 5.00) * 9.00) + 32.00;
    //Serial.print(sensors.getTempCByIndex(0));
    //Serial.print(" degrees C | ");
    //Serial.print(f);
    //Serial.println(" degrees F");
    int int_f = int(f);
    currentMillis_temp = millis();
    if ( currentMillis_temp - previousMillis_temp >= interval ) {
      previousMillis_temp = currentMillis_temp;
      
      Serial.write("T:");
      Serial.print(int_f);
    }
  }
  else{
    count_lp=0;
    //temperature
    BPM = 0;
    count = 0;
  }

}
