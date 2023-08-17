<?php

namespace App\Service;
class CurrencyService{
    protected $soapClient;

    public function __construct()
    {
        $this->soapClient = new \SoapClient("http://example.com/currency-converter?wsdl");
    }

    public function convertCurrency($from, $to, $amount)
    {
        $response = $this->soapClient->convertCurrency([
            'fromCurrency' => $from,
            'toCurrency' => $to,
            'amount' => $amount,
        ]);

        return $response->convertCurrencyResult;
    }
}