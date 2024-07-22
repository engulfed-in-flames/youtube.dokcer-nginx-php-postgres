<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\EmailService;
use PHPUnit\Framework\TestCase;
use App\Services\InvoiceService;
use App\Services\PaymentGatewayService;
use App\Services\SalesTaxService;

class InvoiceServiceTest extends TestCase
{
  public function test_that_it_processes_invoice(): void
  {
    $salesTaxServiceMock = $this->createMock(SalesTaxService::class);
    $gatewayServiceMock = $this->createMock(PaymentGatewayService::class);
    $emailServiceMock = $this->createMock(EmailService::class);

    $gatewayServiceMock->method("charge")->willReturn(true);

    // Given invoice service
    $invoiceService = new InvoiceService(
      $salesTaxServiceMock,
      $gatewayServiceMock,
      $emailServiceMock,
    );

    $customer = ["name" => "Gim"];
    $amount = 3_500;

    // When process is called
    $result = $invoiceService->process($customer, $amount);

    // Then assert invoice is processed successfully
    $this->assertTrue($result);
  }

  public function test_that_it_sends_receipt_email_when_invoice_is_processed()
  {
    $salesTaxServiceMock = $this->createMock(SalesTaxService::class);
    $gatewayServiceMock = $this->createMock(PaymentGatewayService::class);
    $emailServiceMock = $this->createMock(EmailService::class);

    $gatewayServiceMock->method("charge")->willReturn(true);
    $emailServiceMock
      ->expects($this->once())
      ->method("send")
      ->with(["name" => "Gim"], "receipt");

    // Given invoice service
    $invoiceService = new InvoiceService(
      $salesTaxServiceMock,
      $gatewayServiceMock,
      $emailServiceMock,
    );

    // Given invoice service
    $invoiceService = new InvoiceService(
      $salesTaxServiceMock,
      $gatewayServiceMock,
      $emailServiceMock,
    );

    $customer = ["name" => "Gim"];
    $amount = 3_500;

    // When process is called
    $result = $invoiceService->process($customer, $amount);

    // Then assert invoice is processed successfully
    $this->assertTrue($result);
  }
}
