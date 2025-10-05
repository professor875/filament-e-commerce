<?php

namespace App\Filament\Buyer\Pages;

use App\Models\Product;
use Filament\Pages\Page;

class BuyerDashboard extends Page
{
    protected string $view = 'e60dd9d2c3a62d619c9acb38f20d5aa5::filament.buyer.pages.buyer-dashboard';

    protected static string|null|\BackedEnum $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $title = 'Shop Products';

    public $products = [];
    public $quantities = [];

    public function getViewData(): array
    {
        return [
            'products' => Product::where('status', true)->latest()->get(),
        ];
    }

    public function mount()
    {
        // Load available products for buyers
        $this->products = Product::where('status', true)->get();

        foreach ($this->products as $product) {
            $this->quantities[$product->id] = 1;
        }
    }

    // 👇 Livewire action for purchase
    public function purchase($productId)
    {
        $product = Product::findOrFail($productId);

        // Example purchase logic
        Purchase::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
            'total' => $product->price,
        ]);

        Notification::make()
            ->title('Purchase successful!')
            ->success()
            ->send();

        // Optional: Refresh product list
        $this->mount();
    }
}
