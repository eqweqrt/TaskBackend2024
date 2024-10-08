<?php

namespace App\DataTransferObject\Product;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;

class StoreProductData extends Data
{
    public function __construct(
        #[Required, Unique('products', 'name')]
        public string $name,
        #[Nullable, Max(255)]
        public readonly null|string $description,
        #[Required, Numeric]
        public float $price
    ) {}
}
