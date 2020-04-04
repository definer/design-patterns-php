<?php

namespace RefactoringGuru\Strategy\My;
/**
 * RU:
 *
 * В данной стратегии, мы хотим разработать систему оплаты, которая поддерживает возможность разных систем оплат, где каждая содержит в себе необходимые методы
 */

class Context
{
    private $paymentProvider;

    public function __construct(PaymentProvider $paymentProvider)
    {
        $this->paymentProvider = $paymentProvider;
    }

    public function setPaymentProvider(PaymentProvider $paymentProvider)
    {
        $this->paymentProvider = $paymentProvider;
    }

    public function pay(): void
    {
        // Произвести оплату
        echo $this->paymentProvider->pay();
    }

    public function getForm(): void
    {
        // Произвести оплату
        echo $this->paymentProvider->getForm();
    }
}

interface PaymentProvider
{
    public function pay(): string;

    public function getForm(): string;
}

class PayPal implements PaymentProvider
{
    public function pay(): string
    {
        return "Ура, произведена оплата через PayPal\n";
    }

    public function getForm(): string
    {
        return "Форма для оплаты PayPal\n";
    }
}

class UnitPay implements PaymentProvider
{
    public function pay(): string
    {
        return "Ура, произведена оплата через UnitPay\n";
    }

    public function getForm(): string
    {
        return "Форма для оплаты UnitPay\n";
    }
}

function clientcode(PaymentProvider $concreteProvider)
{
    $context = new Context($concreteProvider);

    $context->getForm();
    $context->pay();
}

clientcode(new PayPal());
clientcode(new UnitPay());
