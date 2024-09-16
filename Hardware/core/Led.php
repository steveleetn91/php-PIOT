<?php 
namespace Hardware\HardwareLed;
use Exception;
require_once __DIR__ . '/Hardware.php';
use PIOT\HardwareCore\HardwareInterface;
/**
 * Decorator pattern 
 * Feature of Led at pin 13
 */
interface LedInterface extends HardwareInterface {
    function recieve(string $electronicBoardResponse): string | Exception;
}
class Led implements LedInterface {
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
    public function recieve(string $electronicBoardResponse): string | Exception
    {   
        return intval($electronicBoardResponse) === LED_ON ? 'LED_ON' : 
        (intval($electronicBoardResponse) === LED_OFF ? 'LED_OFF' : throw new \Exception("Not support"));
    }
}