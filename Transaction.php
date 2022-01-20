<?php

class Transaction
{
    public string $identifier;
    public int $timestamp;
    public TransactionLine $line;

    public function setCustomerId(string $id)
    {
        $this->customer_id = $id;
        return $this;
    }

    public function setTransactionLine(TransactionLine $line)
    {
        $this->line = $line;
        return $this;
    }

    public function setTimestamp(int $ts)
    {
        $this->timestamp = $ts;
        return $this;
    }

    public function setIdentifier(string $id)
    {
        $this->identifier = $id;
        return $this;
    }
}

class TransactionLine
{
    public int $price;
    public string $product_name;
    public int $quantity;

    public function __construct($price, $product_name, $quantity)
    {
        $this->price = $price;
        $this->product_name = $product_name;
        $this->quantity = $quantity;
    }
}