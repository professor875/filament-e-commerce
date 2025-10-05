<x-filament::page>
    <style>
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            padding: 1.5rem;
        }

        .product-card {
            border-radius: 12px;
            padding: 5px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            border-radius: 10px;
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        .product-content {
            padding: 1rem;
            color: #fff;
        }

        .product-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.3rem;
        }

        .product-price {
            font-size: 1rem;
            opacity: 0.9;
        }

        .buy-btn {
            border: 1px solid white;
            margin-top: 1rem;
            width: 100%;
            transition: all 0.3s ease;

            &:hover {
                background-color: black;
                color: white;
            }
        }

    </style>

    <div class="product-grid">
        @foreach ($products as $product)
            <div
                class="product-card"
                style="
                    background: linear-gradient(
                        135deg,
                        {{ $product->card_background_color_one ?? '#4f46e5' }},
                        {{ $product->card_background_color_two ?? '#9333ea' }}
                    );
                "
            >
                <img
                    src="{{ asset('storage/' . $product->attachment) }}"
                    alt="{{ $product->name }}"
                    class="product-image"
                >

                <div class="product-content">
                    <h2 class="product-name">{{ $product->name }}</h2>
                    <p class="product-price">${{ number_format($product->price, 2) }}</p>

                    <x-filament::button
                        wire:click="purchase({{ $product->id }})"
                        color="white"
                        class="buy-btn"
                    >
                        Buy Now
                    </x-filament::button>
                </div>
            </div>
        @endforeach
    </div>
</x-filament::page>
