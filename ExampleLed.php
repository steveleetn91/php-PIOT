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
    $led = $hardwareFactory->createLed();
    $led->high();
    $connect->setMessage($led->currentMode());
    $connect->send();
    echo $led->recieve($connect->receive()) . ' | ';

    sleep(3);
    $led->low();
    $connect->setMessage($led->currentMode());
    $connect->send();
    echo $led->recieve($connect->receive()) . ' | ';
    sleep(3);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
