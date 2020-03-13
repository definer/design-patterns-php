<?php

namespace RefactoringGuru\Adapter\Conceptual;

// Есть класс SMS - у которого не понятный интерфейс, его необходимо адаптировать под наши службы

class Ether {

    public function send()
    {
        return 'Send sms fall';
    }
}

class SmsRu {
    public function sendSms()
    {
        return 'Sms sender';
    }
}

class SmsAdapter extends Ether
{
    private $adaptee;

    public function __construct(SmsRu $adaptee)
    {
        $this->adaptee = $adaptee;
    }

    public function send()
    {
        return "Adapter: (Sender) " . $this->adaptee->sendSms();
    }
}

function clientCode(Ether $ether)
{
    return $ether->send();
}

echo clientCode(new SmsAdapter(new SmsRu()));
