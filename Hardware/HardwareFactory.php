<?php 
namespace PIOT\Hardware\Factory;
require_once __DIR__ . '/core/Led.php';
require_once __DIR__ . '/core/LCD1602.php';
use PIOT\HardwareCore\HardwareCore;
use Hardware\HardwareLed\Led;
use Hardware\HardwareLed\LedInterface;
use Hardware\LCD1602\LCD1602;

class HardwareFactory {
    public function createLed() : LedInterface{
        return new Led(new HardwareCore());
    }
    public function createLCD1602() {
        return new LCD1602(new HardwareCore());
    }
}