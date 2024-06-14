<?php

namespace App\DTO\Payment;

use ReflectionClass;
use ReflectionProperty;

class ItemDetailDTO
{
    public int $id;
    public string $name;
    public float $price;
    public string $description;
    public string $item;

    public function __construct(array $parameters = [])
    {
        $class = new ReflectionClass(static::class);

        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $reflectionProperty){
            $property = $reflectionProperty->getName();
            $this->{$property} = $parameters[$property];
        }
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'item' => $this->item,
        ];
    }



}
