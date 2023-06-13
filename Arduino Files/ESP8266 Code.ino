#include <Arduino.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <SoftwareSerial.h>
#include <WiFiClientSecureBearSSL.h>
 
#include <SPI.h>
#include <MFRC522.h>
#define SS_PIN D8
#define RST_PIN D0
#define LED D2
#define LED2 D3
#define LED3 D4

MFRC522 rfid(SS_PIN, RST_PIN); // Instance of the class
MFRC522::MIFARE_Key key;

String cardUID = "";
String cardUID2 = "";
String nodename = "Node X"; //Insert Device Name or PC Number

//#define HOST "taptapuphsl.000webhostapp.com"  // Enter HOST URL without "http:// "  and "/" at the end of URL
#define WIFI_SSID ""                 // WIFI SSID here                                   
#define WIFI_PASSWORD ""     // WIFI password here

//#define WIFI_SSID "Taptapuphsl"                 // WIFI SSID here                                   
//#define WIFI_PASSWORD "taptapwifitesting"     // WIFI password here

const int relay = 5;

String str, postData, postData2;


void setup() {
  pinMode(relay, OUTPUT);
  pinMode(LED,OUTPUT);
  pinMode(LED2,OUTPUT);
  pinMode(LED3,OUTPUT);
  digitalWrite(relay, HIGH);
  digitalWrite(relay, HIGH);
// Open serial communications and wait for port to open:
Serial.begin(115200);
Serial1.begin(115200);
SPI.begin(); // Init SPI bus
rfid.PCD_Init(); // Init MFRC522
for (byte i = 0; i < 6; i++) {
    key.keyByte[i] = 0xFF;
  }



/*
while (!Serial) {
; // wait for serial port to connect. Needed for native USB port only
}*/

  //Serial.println("Communication Started \n\n");
  delay(1000);

  pinMode(LED_BUILTIN, OUTPUT);     // initialize built in led on the board
  
  WiFi.mode(WIFI_STA);
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD); //try to connect with wifi
  
  Serial.print("Connecting to ");
  Serial.print(WIFI_SSID);
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    digitalWrite(LED, HIGH);
    delay(500);
    Serial.print(".");
    digitalWrite(LED,LOW);
    delay(500);
    }
  
  Serial.println();
  digitalWrite(LED, HIGH);
  Serial.print("Connected to ");
  Serial.println(WIFI_SSID);
  Serial.print("IP Address is : ");
  Serial.println(WiFi.localIP());    //print local IP address
  Serial.println(nodename);
  
  delay(30);

}


void loop() { // run over and over


if (!rfid.PICC_IsNewCardPresent()) {
    return;
  }

if (!rfid.PICC_ReadCardSerial()) {
    return;
  }
    // Convert UID bytes to string
cardUID = "";
for (byte i = 0; i < rfid.uid.size; i++) {
  cardUID += String(rfid.uid.uidByte[i], HEX);
}
    

Serial.println(cardUID);
 
// Halt PICC
rfid.PICC_HaltA();
// Stop encryption on PCD
rfid.PCD_StopCrypto1();

//str = Serial.readString();

std::unique_ptr<BearSSL::WiFiClientSecure>client(new BearSSL::WiFiClientSecure);
client->setInsecure();

HTTPClient https;

postData = "str=" + cardUID + "&name=" + nodename;


https.begin(*client, "https://www.taptapuphsl.com/system.php");
https.addHeader("Content-Type", "application/x-www-form-urlencoded");

int httpCode = https.POST(postData);
Serial.println("RFID UID: " + cardUID);

if (httpCode == 200) {
 String uid = https.getString();
 Serial.println("RFID UID Request Sent.");
 Serial.println(uid);
 if (uid == "Match!"){
   digitalWrite(LED2, HIGH);
   digitalWrite(relay,LOW); //nagclose yung circuit parang pinindot yung power button
   delay(500);
   digitalWrite(relay,HIGH); //binitawan yung power button or nag open ulit yung circuit
   digitalWrite(LED2, LOW);
   
 }

}

else {
  Serial.println("HTTP Code: " + httpCode);
  Serial.println("Failed to upload values. \n");
  digitalWrite(LED3, HIGH);
  delay(500);
  digitalWrite(LED3, LOW);
  return;
}

https.end();
Serial.println("putangina");


cardUID2 = "";
while (cardUID != cardUID2)
{
  cardUID2 = "";
  if (rfid.PICC_IsNewCardPresent()){
    Serial.println("may bagong card");

    if (rfid.PICC_ReadCardSerial()){
      Serial.println("binabasa na");
    
  
      // Convert UID bytes to string
      for (byte i = 0; i < rfid.uid.size; i++) {
        cardUID2 += String(rfid.uid.uidByte[i], HEX);
        }

      Serial.println("cardUID: " + cardUID);
      Serial.println("cardUID2: " + cardUID2);
      if( cardUID != cardUID2) {
        digitalWrite(LED3, HIGH);
        delay(500);
        digitalWrite(LED3, LOW);
      }
      
  }
      
   
}
      
// Halt PICC
rfid.PICC_HaltA();
// Stop encryption on PCD
rfid.PCD_StopCrypto1();
}

https.begin(*client, "https://www.taptapuphsl.com/system.php");
https.addHeader("Content-Type", "application/x-www-form-urlencoded");


Serial.println("RFID UID: " + cardUID2);

postData2 = "str=" + cardUID2 + "&name=" + nodename;
int httpCode2 = https.POST(postData2);
if (httpCode == 200) {
 String uid = https.getString();
 Serial.println("RFID UID Request Sent.");
 Serial.println(uid);
 if (uid == "Match!"){
   digitalWrite(LED2, HIGH);
   digitalWrite(relay,LOW); //nagclose yung circuit parang pinindot yung power button
   delay(500);
   digitalWrite(relay,HIGH); //binitawan yung power button or nag open ulit yung circuit
   digitalWrite(LED2, LOW);
 }

}
else {
  digitalWrite(LED3, HIGH);
  Serial.println("HTTP Code: " + httpCode);
  Serial.println("Failed to upload values. \n");
  digitalWrite(LED3, LOW);
  return;
}


}
