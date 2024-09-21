<?php
require_once __DIR__ . '/Defines/pinMode.php';
require_once __DIR__ . '/Adapters/USBConnecting.php';
require_once __DIR__ . '/Hardware/HardwareFactory.php';

use PIOT\USBConnecting\USBConnectingFactory;
use PIOT\Hardware\Factory\HardwareFactory;

try {
    $usbFactory = new USBConnectingFactory();
    $connect = $usbFactory->create(true);
    // change your number com ( USB COM connecting ), at here I have COM3
    $connect->setSerial(3);
    // change BAUD like hardware
    $connect->setBAUD(9600);
    // Delay time for read data from device
    $connect->setReceiveDelay(2);

    $hardwareFactory = new HardwareFactory();
    $lcd = $hardwareFactory->createLCD1604();
    $connect->setMessage($lcd->init());
    $connect->send();
     echo $connect->receive();
     clear($connect,$lcd);
    $connect->setMessage($lcd->display(0,0,"Current Time    PHP Version     "));
    $connect->send();
    echo $connect->receive();
    while(true) {
        $connect->setMessage($lcd->display(1,0,date('m-d H:i:s',time())) . '  ' . PHP_VERSION . '         >>        ');
        $connect->send();
        echo $connect->receive();
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}


function clear($connect,$lcd){
    $connect->setMessage($lcd->clear());
    $connect->send();
    echo $connect->receive();
}