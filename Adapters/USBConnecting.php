<?php 
/**
 * USB Connect 
 * Design pattern 
 * Currently only support for windows
 */
namespace PIOT\USBConnecting;
interface USBConnectingInterface{
   function setSerial(int $serial): void;
   function getSerial(): int;
   function setReceiveDelay(int $delay) : void;
   function getReceiveDelay() : int;
   function setBAUD(int $baud) : void;
   function getBAUD(): int;
    function setMessage(string $message): void; 
    function getMessage(): string;
}

class MYCOM implements USBConnectingInterface {
    private int $port;
    private string $message;
    private int $receiveDelay;
    private int $baud;
    public function setSerial(int $port): void
    {
        $this->port = $port;
    }
    public function getSerial() : int
    {
        return $this->port;
    }
    public function setReceiveDelay(int $delay = 500) : void
    {
        $this->receiveDelay = $delay;
    }
    public function getReceiveDelay() : int {
        return $this->receiveDelay;
    }
    public function setBAUD(int $baud): void
    {
        $this->baud = $baud;
    }
    public function getBAUD(): int{
        return $this->baud;
    }
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
    public function getMessage(): string
    {
        return $this->message;
    }
}

class WindowsCOM implements USBConnectingInterface {
    public function __construct(private USBConnectingInterface $core )
    {
        
    }
    public function setSerial(int $port): void
    {
        $this->core->setSerial($port);
    }
    public function getSerial(): int
    {
        return $this->core->getSerial();
    }
    public function setReceiveDelay(int $delay): void
    {
        $this->core->setReceiveDelay($delay);
    }
    public function getReceiveDelay(): int
    {
        return $this->core->getReceiveDelay();
    }
    public function fullSerial(): string{
        return "COM" . $this->getSerial();
    }
    public function setBAUD(int $baud): void
    {
        $this->core->setBAUD($baud);
    }
    public function getBAUD(): int
    {
        return $this->core->getBAUD();
    }
    public function setMessage(string $message): void
    {
        $this->core->setMessage($message);
    }
    public function getMessage(): string
    {
        return $this->core->getMessage();
    }
    public function send(){
        $sendCommand = 'PowerShell -Command "$port = new-Object System.IO.Ports.SerialPort COM' . $this->getSerial() 
            . ','.$this->getBAUD().',None,8,one; $port.Open(); $port.WriteLine(\'' . $this->getMessage() . '\'); $port.Close();"';
        exec($sendCommand);
    }
    public function receive(){
        $readCommand = 'PowerShell -Command "$port = new-Object System.IO.Ports.SerialPort COM' 
            . $this->getSerial() . ','.$this->getBAUD().',None,8,one; $port.Open(); Start-Sleep -Seconds ' 
            . $this->getReceiveDelay() . '; $data = $port.ReadExisting(); $port.Close(); $data"';
        return intval(shell_exec($readCommand)) === LED_ON ? 'Led on' : 'Led off';
    }
} 


class USBConnectingFactory {
    public function create(bool $isWindows) {
        if($isWindows) {
            return new WindowsCOM(new MYCOM());
        }
        throw "Currently only support for Windows";
    }
}