#include <WiFi.h>
#include <HTTPClient.h>

const char* ssid = "alpha";
const char* password =  "12345678";

void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);
  delay(4000);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) { //Check for the connection
    delay(500);
    Serial.println("Connecting..");
  }

  Serial.print("Connected to the WiFi network with IP: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  String val = Serial.readString();
  if (val != "") {
    Serial.println(val);
    if (WiFi.status() == WL_CONNECTED) { //Check WiFi connection status
      HTTPClient http;
      String link = "http://192.168.0.113/medical/get_bpm_temp.php?data="+val;
      http.begin(link);  //Specify destination for HTTP request
      http.addHeader("Content-Type", "text/plain");             //Specify content-type header

      int httpResponseCode = http.GET();   //Send the actual POST request

      if (httpResponseCode > 0) {
        String payload = http.getString();
        Serial.println(httpResponseCode);   //Print return code
        Serial.println(payload);
      } else {
        Serial.print("Error on sending request: ");
        Serial.println(httpResponseCode);
      }
      http.end();  //Free resources
    } else {
      Serial.println("Error in WiFi connection");
    }
  }

}
