<?php 
require_once __DIR__ . '/Defines/pinMode.php';
require_once __DIR__ . '/Adapters/USBConnecting.php';
require_once __DIR__ . '/Hardware/HardwareFactory.php';
use PIOT\USBConnecting\USBConnectingFactory;
use PIOT\Hardware\Factory\HardwareFactory;

try {
    $usbFactory = new USBConnectingFactory();
    $connect = $usbFactory->create(true);
    $connect->setSerial(3);
    $connect->setBAUD(9600);
    $connect->setReceiveDelay(3);

    $hardwareFactory = new HardwareFactory();
    $lcd = $hardwareFactory->createLCD1602();
    $lcd->high();
    $connect->setMessage($lcd->displayText("Current time: ",true,0));
    $connect->send();
    echo $lcd->receive($connect->receive()) . ' | ';
    $connect->setMessage($lcd->displayText(date('Y-m-d H:i:s',time()),false,0));
    $connect->send();
    echo $lcd->receive($connect->receive()) . ' | ';

}catch(\Exception $e) {
    echo "ERRORS: " . $e->getMessage();
}