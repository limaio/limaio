
#include "DHT.h"
#include <SPI.h>
#include <Ethernet.h>
#include <SimpleTimer.h>

#define DHTTYPE DHT22
#define DHTPIN 3

int dustPin=0;
int dustVal=0;
int ledPower=2;
int delayTime=280;
int delayTime2=40;
float offTime=9680;
float t;
float h;
int ruido = 0;
int ruidotemp = 0;

DHT dht(DHTPIN, DHTTYPE);
SimpleTimer timer;

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
IPAddress server(96,126,113,6); //arenalabs.pe
EthernetClient client;

void setup() {
  Serial.begin(9600);
  timer.setInterval(60000, SendVals);

   while (!Serial) {
    ; 
  }
  pinMode(ledPower,OUTPUT);
  pinMode(4, OUTPUT);
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to configure Ethernet using DHCP");
    for(;;)
      ;      
  }
  Serial.println("setup complete");
}

void loop()
{
  timer.run();
  ruidotemp = analogRead(2);
  
  if (ruidotemp > ruido)
  { 
  ruido = ruidotemp;
  }
}


void SendVals()
{

  digitalWrite(ledPower,LOW); 
  delayMicroseconds(delayTime);
  dustVal=analogRead(dustPin); 
  delayMicroseconds(delayTime2);
  digitalWrite(ledPower,HIGH); 
  delayMicroseconds(offTime);
  
  int UVI = analogRead(3);
  int gases = analogRead(1);
  t = dht.readTemperature();
  h = dht.readHumidity();
  
  
  Serial.println("connecting...");

  if (client.connect(server, 80)) {
    Serial.println("connected");

    client.print("GET /sites/all/insert.php?s1=");
    client.print(t);
    client.print("&s2=");
    client.print(h);
    client.print("&s3=");
    client.print(UVI);
    client.print("&s4=");
    client.print(ruido); 
    client.print("&s5=");
    client.print(gases);  
    client.print("&s6=");
    client.print(dustVal);      
    client.println(" HTTP/1.0");
    client.println();
    
    Serial.println();
    Serial.print("T :");
    Serial.println(t);
    Serial.print("H: ");
    Serial.println(h);
    Serial.print("UVI: ");
    Serial.println(UVI);
    Serial.print("ruido :");
    Serial.println(ruido);
    Serial.print("gases: ");
    Serial.println(gases);    
    Serial.print("polvo: ");
    Serial.println(dustVal);    
  } 
    client.stop();
    ruido = 0;
    ruidotemp = 0;
  }
