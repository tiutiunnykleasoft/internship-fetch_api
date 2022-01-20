<?php

/** @template T */
class Collection
{
    public int $position;
    /** @var array<T> */
    private array $items;

    public function __construct()
    {
        $this->position = 1;
    }

    /** @param T $item */
    public function add(mixed $item, $key = null)
    {
        if ($key) {
            $this->items[$key] = $item;
        } else {
            $this->items[$this->position] = $item;
            return $this->position++;
        }
    }

    public function getAllByField($field, $value)
    {
        $response = [];
        foreach ($this->items as $item) {
            if (property_exists($item, $field) && $item->$field == $value) {
                $response[] = $item;
            }
        }
        return $response;
    }

    /** @return T */
    public function get($key)
    {
        if (array_key_exists($key, $this->items)) {
            return $this->items[$key];
        } else {
            return ["message" => "Not found entity with key : " . $key];
        }
    }

    /** @return array<int> */
    public function getKeys(): array
    {
        return array_keys($this->items);
    }
}