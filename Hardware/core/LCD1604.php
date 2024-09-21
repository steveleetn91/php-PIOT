<?php 
namespace Hardware\HardwareLCD1604;
use PIOT\HardwareCore\HardwareInterface;
use Exception;
require_once __DIR__ . '/Hardware.php';
interface LCD1604Interface extends HardwareInterface {
    function display(int $row,int $column, string $message): string;
    function receive(string $receive): string | Exception;
    function init(): string;
    function clear(): string;
}
class LCD1604 implements LCD1604Interface {
    private string $messageFormat = LCD1604 . "r[COUNT]c[COUNT][CONTENT][END]";
    private int $row = 0;
    private int $column = 0; 
    private string $message;
    function __construct(private HardwareInterface $hardware )
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
    public function currentMode(): string
    {
        return LCD1604 . "LCD1604" .$this->hardware->currentMode() . "[END]";    
    }
    public function init() : string{
        return LCD1604 . "LCD1604INIT[END]";
    }
    public function display(int $row,int $column, string $message): string
    {
        $this->row = $row;
        $this->column = $column;
        $this->message = $message;
        return str_replace(["r[COUNT]","c[COUNT]","[CONTENT]"],
        ["r" . $row,"c" . $column,$this->message],$this->messageFormat);
    }
    public function receive(string $receive): string | Exception
    {
        return $this->display($this->row,$this->column,$this->message) === $receive ? "LCD1604 OK" : throw new \Exception("LCD1604 UNSUPPORT");
    }
    public function clear(): string
    {
        return LCD1604 . "LCD1604CLEAR[END]";
    }
}