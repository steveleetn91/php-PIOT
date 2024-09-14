![Alt text](banner.png)

# php-PIOT
This is a framework support for you control to electronic board as Uno, Esp32, Esp8266, Atmega2560 ...etc

# Support features
        | Feature      | LED  |
        |--------------|------|
        | LED          | ✔    | 
        | LCD 1620     |      |
        | LCD 1604     |      |    
        | LCD OLED     |      |  
        | SD Card      |      |    
        | OV2640       |      |     
        | L293D        |      |     
        | L293D        |      |     
        | Arduino CNC  |      |
        | Shield V3    |      |
        | ESP8266      |      |

# How to install? 
First you need connect your electronic board by USB. After you need check what's number COM?
Next step you need download this repo and try control led feature.

    ```
        <?php 
            require_once __DIR__ . '/Defines/pinMode.php';
            require_once __DIR__ . '/Adapters/USBConnecting.php';
            require_once __DIR__ . '/Hardware/HardwareFactory.php';
            use PIOT\USBConnecting\USBConnectingFactory;
            use PIOT\Hardware\Factory\HardwareFactory;

            $usbFactory = new USBConnectingFactory();
            $connect = $usbFactory->create(true);
            $connect->setSerial(3);
            $connect->setBAUD(9600);
            $connect->setReceiveDelay(3);

            $hardwareFactory = new HardwareFactory();
            $led = $hardwareFactory->createLed();
            $led->high();
            $connect->setMessage($led->currentMode());
            $connect->send();
            echo $connect->receive() . ' | ';

            sleep(3);
            $led->low();
            $connect->setMessage($led->currentMode());
            $connect->send();
            echo $connect->receive() . ' | ';
            sleep(3);
    ```
