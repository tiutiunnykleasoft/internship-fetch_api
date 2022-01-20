<?php
require_once "Collection.php";
require_once "User.php";
require_once "Collection.php";
require_once "Transaction.php";

const PRODUCTS = ['Milk', 'Water', 'Car', 'Paper', 'Pencil', 'Coca-cola', 'PC', 'Laptop', 'Notebook', 'Smartphone', 'Gun', 'Panda', 'Board game', 'Porridge', 'Cherry', 'Banana', 'Pineapple', 'Nuts', 'Snickers', 'Milky way', 'Cup', 'Vodka', 'Juice', 'Candy', 'Rabbit', 'Circle', 'Heaters', 'T-shirt'];
const STATUSES = ['active', 'passive', 'semi'];
const NAMES_FIRST = ['fire', 'fast', 'quick', 'invisible', 'resistance', 'cold', 'warm', 'fine', 'smile', 'angry', 'sexy', 'glory', 'tricky', 'hidden', 'big', 'small', 'baby', 'great'];
const NAMES_SECOND = ['gatsby', 'spider', 'cherry', 'pumpkin', 'sneaker', 'cucumber', 'balloon', 'president', 'children', 'student', 'computer', 'fox', 'snail', 'butterfly', 'phone', 'friend', 'warrior'];
const EMAIL_END = ['ua', 'world', 'com', 'no', 'kh', 'plt', 'tv', 'mini', 'inbox', 'indoor', 'box'];
const EMAIL_MIDDLE = ['commerce', 'payment', 'leaves', 'trees', 'shield', 'star', 'track', 'site', 'ucoz', 'google', 'gmail', 'meta', 'suprunovka', 'khpi'];

/** @var Collection<\User> $users */
$users = new Collection();

/** @var Collection<\Transaction> $transactions */
$transactions = new Collection();

function generateTransaction(&$transactions, $id)
{
    $transactions->add(
        (new Transaction())
            ->setCustomerId($id)
            ->setIdentifier(uniqid())
            ->setTimestamp(rand(1642000000, 1642004589))
            ->setTransactionLine(
                new TransactionLine(
                    rand(101, 1000),
                    generateProductName(),
                    rand(0, 100)
                )
            )
    );
}

function generateUserName(): string
{
    return implode('-', [
        NAMES_FIRST[rand(0, count(NAMES_FIRST) - 1)],
        NAMES_SECOND[rand(0, count(NAMES_SECOND) - 1)]
    ]);
}

function generateEmail($username): string
{
    return implode('@', [
        $username,
        implode('.', [
            EMAIL_MIDDLE[rand(0, count(EMAIL_MIDDLE) - 1)],
            EMAIL_END[rand(0, count(EMAIL_END) - 1)]
        ])
    ]);
}

function generateProductName(): string
{
    return PRODUCTS[rand(0, count(PRODUCTS) - 1)];
}

function generateStatus(): string
{
    return STATUSES[rand(0, count(STATUSES) - 1)];
}

for ($i = 0; $i <= rand(0, 30); $i++) {
    $username = generateUserName();
    $id = $users->add(
        (new User())
            ->setName($username)
            ->setEmail(generateEmail($username))
            ->setStatus(generateStatus())
    );
    for ($i = 0; $i <= rand(0, 10); $i++) {
        generateTransaction($transactions, $id);
    }
}
