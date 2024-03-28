#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <DHT.h>
#include <ESP8266HTTPClient.h>

#define DHTPIN D1
#define DHTTYPE DHT11

#define MQ135_PIN A0

DHT dht(DHTPIN, DHTTYPE);

const char* ssid = "robot";
const char* password = "robot123";

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

void sendAirData(float co2, float lpg, float benzin, float no2) {
  HTTPClient http;
  WiFiClient client;

  String url = "http://192.168.93.48:8000/store-air-quality?co2=" + String(co2) +
               "&lpg=" + String(lpg) +
               "&benzin=" + String(benzin) +
               "&no2=" + String(no2);

  Serial.print("Sent Request to: ");
  Serial.println(url);

  http.begin(client,url.c_str()); // Specify request destination

  // Send HTTP GET request
  int httpResponseCode = http.GET();

  if (httpResponseCode != HTTP_CODE_OK) {
    Serial.println("HTTP request Successful");
    // String response = http.getString();
    // Serial.print("Response: ");
    // Serial.println(response);
  } else {
    Serial.print("Error code: ");
    Serial.println(httpResponseCode);
    Serial.println("HTTP request failed");
  }

  http.end(); // Free resources
}
void sendTemperatureData(float temperature) {
  WiFiClient client;
  HTTPClient http;

  String url = "http://192.168.93.48:8000/store-temperature?temperature=" + String(temperature);

  Serial.print("Sent Request to: ");
  Serial.println(url);

  http.begin(client, url.c_str()); // Specify request destination

  // Send HTTP GET request
  int httpResponseCode = http.GET();

  if (httpResponseCode != HTTP_CODE_OK) {
    Serial.println("HTTP request Successful");
    // String response = http.getString();
    // Serial.print("Response: ");
    // Serial.println(response);
  } else {
    Serial.print("Error code: ");
    Serial.println(httpResponseCode);
    Serial.println("HTTP request failed");
  }

  http.end(); // Free resources
}
void sendHumidityData(float humidity) {
  WiFiClient client;
  HTTPClient http;

  String url = "http://192.168.93.48:8000/store-humidity?humidity=" + String(humidity);

  Serial.print("Sent Request to: ");
  Serial.println(url);

  http.begin(client, url.c_str()); // Specify request destination

  // Send HTTP GET request
  int httpResponseCode = http.GET();

  if (httpResponseCode != HTTP_CODE_OK) {
    Serial.println("HTTP request Successful");
    // String response = http.getString();
    // Serial.print("Response: ");
    // Serial.println(response);
  } else {
    Serial.print("Error code: ");
    Serial.println(httpResponseCode);
    Serial.println("HTTP request failed");
  }

  http.end(); // Free resources
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
  sendAirData(ppmCO2, ppmLPG, ppmBenzin, ppmNO2);
  sendTemperatureData(temperature);
  sendHumidityData(humidity);
  delay(10000);
}
