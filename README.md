# TAPTAP: Arduino-Based RFID Scanner for User Logging and Controlled Access of Computers
Thesis Study

TAPTAP is a thesis project that aids in monitoring students in the Computer Laboratory of the College of Computer Studies at UPHSL. The system utilized the NodeMCU ESP8266 and the Arduino Leonardo as its main microcontrollers for the hardware, and PHP, CSS, and HTML as the main software tool used in producing reports such as viewing user database, registering new users and admins, and lastly, viewing user logging of users.

The Arduino Leonardo is used to scan RFID tags and input it to the computer by emulating a keyboard for registering new users.
The ESP 8266 is also used to scan RFID tags which then sends to an online database via a PHP script which then verifies if a user exists with the scanned RFID tag. If there is a match, the computer will turn on else, it will reject access to the computer.
