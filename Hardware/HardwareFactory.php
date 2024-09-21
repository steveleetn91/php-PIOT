<?php 
namespace PIOT\Hardware\Factory;
require_once __DIR__ . '/core/Led.php';
require_once __DIR__ . '/core/LCD1604.php';

use Hardware\HardwareLCD1604\LCD1604;
use Hardware\HardwareLCD1604\LCD1604Interface;
use PIOT\HardwareCore\HardwareCore;
use Hardware\HardwareLed\Led;
use Hardware\HardwareLed\LedInterface;
class HardwareFactory {
    public function createLed() : LedInterface{
        return new Led(new HardwareCore());
    }
    public function createLCD1604() : LCD1604Interface {
        return new LCD1604(new HardwareCore());
    } 
}