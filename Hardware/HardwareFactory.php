<?php 
namespace PIOT\Hardware\Factory;
require_once __DIR__ . '/core/Led.php';
use PIOT\HardwareCore\HardwareCore;
use Hardware\HardwareLed\Led;
class HardwareFactory {
    public function createLed(){
        return new Led(new HardwareCore());
    }
}