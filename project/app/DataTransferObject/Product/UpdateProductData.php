<?php

namespace App\DataTransferObject\Product;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Data;

class UpdateProductData extends Data
{
    public function __construct(
        #[Nullable, Max(255)]
        public readonly null|string $description,
    ) {}
}
