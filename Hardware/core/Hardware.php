<?php 
namespace PIOT\HardwareCore;
interface HardwareInterface {
    function low() : int;
    function high() : int;
    function currentMode() : int;
}

class HardwareCore implements HardwareInterface {
    public int $pin;
    public int $mode;
    public function low(): int {
        return $this->mode = 0;
    }
    public function high(): int {
        return $this->mode = 1;
    }
    public function currentMode() : int{
        return $this->mode;
    }
}
