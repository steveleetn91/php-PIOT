<?php 
namespace Hardware\HardwareLed;
require_once __DIR__ . '/Hardware.php';
/**
 * Decorator pattern 
 * Feature of Led at pin 13
 */
use PIOT\HardwareCore\HardwareInterface;
class Led implements HardwareInterface {
    public function __construct(private HardwareInterface $hardware)
    {
        
    }
    public function low(): int
    {
        return $this->hardware->low();
    }
    public function high(): int
    {
        return $this->hardware->high();
    }
    public function currentMode() : int{
        return $this->hardware->currentMode() === 0 ? LED_OFF : LED_ON;
    }
}