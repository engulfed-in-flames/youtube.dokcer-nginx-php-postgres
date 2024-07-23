<?php

declare(strict_types=1);

namespace App\Services;

// Simulation
class InvoiceService
{
  public function __construct(
    protected SalesTaxService $salesTaxService,
    protected PaymentGatewayInterface $gatewayService,
    protected EmailService $emailService
  ) {
  }

  public function process(array $customer, float $amount): bool
  {
    // 1. calculate sales tax
    $tax = $this->salesTaxService->calculate($amount, $customer);

    // 2. process invoice
    if (!$this->gatewayService->charge($customer, $amount, $tax)) {
      return false;
    }

    // 3. send receipt
    $this->emailService->send($customer, 'receipt');

    return true;
  }
}
