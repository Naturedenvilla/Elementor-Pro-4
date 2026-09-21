<?php

class Customer
{
    public function __construct(
        public string $name,
        public string $email,
        public float $spent
    ) {}
}

class CustomerManager
{
    private array $customers = [];

    public function addCustomer(string $name, string $email, float $spent): void
    {
        $this->customers[] = new Customer($name, $email, $spent);
    }

    public function sortBySpent(): void
    {
        usort(
            $this->customers,
            fn(Customer $a, Customer $b) => $b->spent <=> $a->spent
        );
    }

    public function getTotalSpent(): float
    {
        return array_sum(
            array_map(fn(Customer $customer) => $customer->spent, $this->customers)
        );
    }

    public function printReport(): void
    {
        echo "Customer Report\n";
        echo "===============\n";

        foreach ($this->customers as $customer) {
            echo "{$customer->name} | {$customer->email} | $" .
                number_format($customer->spent, 2) . PHP_EOL;
        }

        echo "===============\n";
        echo "Customers: " . count($this->customers) . PHP_EOL;
        echo "Total Spent: $" . number_format($this->getTotalSpent(), 2) . PHP_EOL;
    }
}

$manager = new CustomerManager();

$manager->addCustomer("Alice", "alice@example.com", 1250.50);
$manager->addCustomer("Brian", "brian@example.com", 875.25);
$manager->addCustomer("Clara", "clara@example.com", 2140.75);
$manager->addCustomer("David", "david@example.com", 640.00);

$manager->sortBySpent();
$manager->printReport();