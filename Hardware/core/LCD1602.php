<?php 
namespace Hardware\LCD1602;
require_once __DIR__ . '/Hardware.php';

use Exception;
use PIOT\HardwareCore\HardwareInterface;

interface LCD1602Interface extends HardwareInterface {
    function displayText(string $text, bool $isFirst, int $position): string;
    function receive(string $electronicBoardResponse) : string | Exception;
}

class LCD1602 implements LCD1602Interface {
    private string $text;
    private bool $isFirst;
    private int $position;
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
    public function currentMode(): int
    {
        return $this->hardware->currentMode() === 0 ? "LCD1602ON" : "LCD1602OFF";
    }
    public function receive(string $electronicBoardResponse) : string | Exception {
        if($electronicBoardResponse === $this->displayText($this->text, $this->isFirst, $this->position)) {
            return "LCD1602 is show";
        }
        throw new \Exception('Not support');
    }
    public function displayText(string $text, bool $isFirst, int $position = 0) : string {
        $this->isFirst = $isFirst;
        $this->position = $position;
        $this->text = $this->text;
        return "LCD1602|" . ($this->isFirst ? 1 : 2) . "|" . $this->position . "|" . $this->text . "|LCD1602";
    }
}