#include <TinyGPS++.h>
#include <SoftwareSerial.h>
/* Create object named SIM900 of the class SoftwareSerial */

static const int RXPin1 = 22, TXPin1 = 23, RXPin2 = 03, TXPin2 = 01;
static const uint32_t DEFAULTBaud = 9600;

// The TinyGPS++ object
TinyGPSPlus gps;


// The serial connection to the GPS device
SoftwareSerial ss(RXPin2, TXPin2);
SoftwareSerial gprsSerial(RXPin1, TXPin1);

bool gsm_f = false;

void setup()
{
  gprsSerial.begin(DEFAULTBaud); // the GPRS baud rate   
  Serial.begin(DEFAULTBaud); // the GPRS baud rate 
  ss.begin(DEFAULTBaud);
  delay(1000);
  print("\nInitializing...\n\n");
  print("\nConecting to the GPS Satellites...\n");
}
 
void loop()
{
  // This sketch displays information every time a new sentence is correctly encoded.
  while (ss.available() > 0){
    gps.encode(ss.read());
    if (gps.location.isUpdated()){

      print("\n Reading the location data\n\n");

      double latitude, longitude;
      
      latitude = gps.location.lat(); // Latitude in degrees (double)
      longitude = gps.location.lng(); // Longitude in degrees (double)
  
      Serial.print("Latitude= ");
      Serial.print(latitude);
      Serial.print(" Longitude= ");
      Serial.print(longitude);


      //  Connect wit sim900a GPRS Connection
      if(!gsm_f){
        gsm_f=true;
        Serial.print("\nInitiating GPRS Connection...\n");
        start_gsm_connection();
      }

      send_data_to_server(latitude, longitude);

    }
  }
}


void send_data_to_server(float h, float t)
{
  gprsSerial.println("AT+CIPSPRT=0");
  delay(3000);
  ShowSerialData();
  
  gprsSerial.println("AT+CIPSTART=\"TCP\",\"api.thingspeak.com\",\"80\"");//start up the connection
  delay(6000);
  ShowSerialData();
 
  gprsSerial.println("AT+CIPSEND");//begin send data to remote server
  delay(4000);
  ShowSerialData();
  
  String str="GET https://api.thingspeak.com/update?api_key=NDSHY84YT0NXMKTO&field1=" + String(h) +"&field2="+String(t);
  Serial.println(str);
  gprsSerial.println(str);//begin send data to remote server
  
  delay(4000);
  ShowSerialData();
 
  gprsSerial.println((char)26);//sending
  delay(5000);//waitting for reply, important! the time is base on the condition of internet 
  gprsSerial.println();
 
  ShowSerialData();

  gprsSerial.println("AT+CIPSHUT");//close the connection
  delay(100);
  ShowSerialData();

}

void start_gsm_connection()
{
  gprsSerial.println("AT");
  delay(1000);
 
  gprsSerial.println("AT+CPIN?");
  delay(1000);
 
  gprsSerial.println("AT+CREG?");
  delay(2000);
 
  gprsSerial.println("AT+CGATT?");
  delay(1000);
 
  gprsSerial.println("AT+CIPSHUT");
  delay(1000);
 
  gprsSerial.println("AT+CIPSTATUS");
  delay(2000);
 
  gprsSerial.println("AT+CIPMUX=0");
  delay(2000);
 
  ShowSerialData();
 
  gprsSerial.println("AT+CSTT=\"www\"");//start task and setting the APN,
  delay(1000);
 
  ShowSerialData();
 
  gprsSerial.println("AT+CIICR");//bring up wireless connection
  delay(3000);
 
  ShowSerialData();
 
  gprsSerial.println("AT+CIFSR");//get local IP adress
  delay(2000);
 
  ShowSerialData();
}

void ShowSerialData()
{
  while(gprsSerial.available()!=0)
  Serial.write(gprsSerial.read());
  delay(5000);
}


void print(char *str){
  Serial.print(str);
}
