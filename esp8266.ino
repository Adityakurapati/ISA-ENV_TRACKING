#include <ESP8266WiFi.h>
#include <DHT.h>
#include <ESP8266HTTPClient.h>

#define DHTPIN D1
#define DHTTYPE DHT22

#define MQ135_PIN A0

DHT dht(DHTPIN, DHTTYPE);

const char* ssid = "GX_SECURITY";
const char* password = "123456789";
const char* serverUrlAirQuality = "http://your-laravel-website-url.com/store-air-quality"; // Change this to your Laravel website URL for air quality
const char* serverUrlTemperature = "http://your-laravel-website-url.com/store-temperature"; // Change this to your Laravel website URL for temperature
const char* serverUrlHumidity = "http://your-laravel-website-url.com/store-humidity"; // Change this to your Laravel website URL for humidity

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
  HTTPClient httpAirQuality;
  httpAirQuality.begin(serverUrlAirQuality);
  httpAirQuality.addHeader("Content-Type", "application/x-www-form-urlencoded");

  String postDataAirQuality = "ppmCO2=" + String(ppmCO2) + "&ppmLPG=" + String(ppmLPG) +
                              "&ppmBenzin=" + String(ppmBenzin) + "&ppmNO2=" + String(ppmNO2);

  int httpResponseCodeAirQuality = httpAirQuality.POST(postDataAirQuality);
  if (httpResponseCodeAirQuality > 0) {
    Serial.print("HTTP Response code for Air Quality: ");
    Serial.println(httpResponseCodeAirQuality);
    String responseAirQuality = httpAirQuality.getString();
    Serial.println(responseAirQuality);
  } else {
    Serial.print("HTTP POST request failed for Air Quality, error: ");
    Serial.println(httpResponseCodeAirQuality);
  }

  httpAirQuality.end();
}

void sendTemperature(float temperature) {
  HTTPClient httpTemperature;
  httpTemperature.begin(serverUrlTemperature);
  httpTemperature.addHeader("Content-Type", "application/x-www-form-urlencoded");

  String postDataTemperature = "temperature=" + String(temperature);

  int httpResponseCodeTemperature = httpTemperature.POST(postDataTemperature);
  if (httpResponseCodeTemperature > 0) {
    Serial.print("HTTP Response code for Temperature: ");
    Serial.println(httpResponseCodeTemperature);
    String responseTemperature = httpTemperature.getString();
    Serial.println(responseTemperature);
  } else {
    Serial.print("HTTP POST request failed for Temperature, error: ");
    Serial.println(httpResponseCodeTemperature);
  }

  httpTemperature.end();
}

void sendHumidity(float humidity) {
  HTTPClient httpHumidity;
  httpHumidity.begin(serverUrlHumidity);
  httpHumidity.addHeader("Content-Type", "application/x-www-form-urlencoded");

  String postDataHumidity = "humidity=" + String(humidity);

  int httpResponseCodeHumidity = httpHumidity.POST(postDataHumidity);
  if (httpResponseCodeHumidity > 0) {
    Serial.print("HTTP Response code for Humidity: ");
    Serial.println(httpResponseCodeHumidity);
    String responseHumidity = httpHumidity.getString();
    Serial.println(responseHumidity);
  } else {
    Serial.print("HTTP POST request failed for Humidity, error: ");
    Serial.println(httpResponseCodeHumidity);
  }

  httpHumidity.end();
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

  delay(2000);
}
