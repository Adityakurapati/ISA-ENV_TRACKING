#include <ESP8266WiFi.h>
#include <DHT.h>
#include <ESP8266HTTPClient.h>

#define DHTPIN D1
#define DHTTYPE DHT22

#define MQ135_PIN A0

DHT dht(DHTPIN, DHTTYPE);

const char* ssid = "GX_SECURITY";
const char* password = "123456789";
const char* serverUrlAirQuality = "http://127.0.0.1:8000/store-air-quality"; 
const char* serverUrlTemperature = "http://127.0.0.1:8000/store-temperature"; 
const char* serverUrlHumidity = "http://127.0.0.1:8000/store-humidity"; 

void setup() {
  Serial.begin(9600);
  delay(100);

  // Connect to WiFi
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());

  dht.begin();
}

void sendAirQuality(float ppmCO2, float ppmLPG, float ppmBenzin, float ppmNO2) {
  WiFiClient client;
  
  String url = serverUrlAirQuality + "?co2=" + String(ppmCO2) +
               "&lpg=" + String(ppmLPG) +
               "&benzin=" + String(ppmBenzin) +
               "&no2=" + String(ppmNO2);

  Serial.print("Sending Air Quality data to: ");
  Serial.println(url);

  if (client.connect(server, 80)) {
    client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                 "Host: " + server + "\r\n" +
                 "Connection: close\r\n\r\n");
    delay(10);
    while (client.available()) {
      String line = client.readStringUntil('\r');
      Serial.print(line);
    }
    client.stop();
  } else {
    Serial.println("Unable to connect to server");
  }
}

void sendTemperature(float temperature) {
  WiFiClient client;
  
  String url = serverUrlTemperature + "?temperature=" + String(temperature);

  Serial.print("Sending Temperature data to: ");
  Serial.println(url);

  if (client.connect(server, 80)) {
    client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                 "Host: " + server + "\r\n" +
                 "Connection: close\r\n\r\n");
    delay(10);
    while (client.available()) {
      String line = client.readStringUntil('\r');
      Serial.print(line);
    }
    client.stop();
  } else {
    Serial.println("Unable to connect to server");
  }
}

void sendHumidity(float humidity) {
  WiFiClient client;
  
  String url = serverUrlHumidity + "?humidity=" + String(humidity);

  Serial.print("Sending Humidity data to: ");
  Serial.println(url);

  if (client.connect(server, 80)) {
    client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                 "Host: " + server + "\r\n" +
                 "Connection: close\r\n\r\n");
    delay(10);
    while (client.available()) {
      String line = client.readStringUntil('\r');
      Serial.print(line);
    }
    client.stop();
  } else {
    Serial.println("Unable to connect to server");
  }
}

void loop() {
  // Read temperature, humidity, and air quality
  float humidity = dht.readHumidity();
  float temperature = dht.readTemperature();

  if (isnan(humidity) || isnan(temperature)) {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }

  Serial.print("Temperature: ");
  Serial.print(temperature);
  Serial.println(" °C");
  Serial.print("Humidity: ");
  Serial.print(humidity);
  Serial.println(" %");

  // Read air quality
  float airQuality = analogRead(MQ135_PIN);
  float voltage = airQuality * (5.0 / 1023.0);
  float ratio = voltage / 5.0;
  float ppmCO2 = (ratio / 0.21) * 10000; // CO2 concentration in ppm
  float ppmLPG = (ratio / 0.5) * 10; // LPG concentration in ppm
  float ppmBenzin = (ratio / 0.45) * 10; // Benzin concentration in ppm
  float ppmNO2 = (ratio / 0.67) * 10; // NO2 concentration in ppm

  Serial.print("CO2 concentration: ");
  Serial.print(ppmCO2);
  Serial.println(" ppm");
  Serial.print("LPG concentration: ");
  Serial.print(ppmLPG);
  Serial.println(" ppm");
  Serial.print("Benzin concentration: ");
  Serial.print(ppmBenzin);
  Serial.println(" ppm");
  Serial.print("NO2 concentration: ");
  Serial.print(ppmNO2);
  Serial.println(" ppm");

  // Send data
  sendAirQuality(ppmCO2, ppmLPG, ppmBenzin, ppmNO2);
  sendTemperature(temperature);
  sendHumidity(humidity);

  delay(3000);
}
