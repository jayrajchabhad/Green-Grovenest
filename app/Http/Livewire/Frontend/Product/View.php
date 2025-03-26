<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\wishlists;
use App\Models\cart;
use App\Models\RecommendatProduct;
use App\Models\Product;

class View extends Component
{
    public $category,$product,$prodColorSelectedQuantity,$quantityCount = 1,$productColorId;

    public function addToWishlist($productId)
    {
        if(Auth::check())
        {
            if(wishlists::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists())
            {

                session()->flash('message', 'Already Added To Wishlist');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Already Added To Wishlist',
                    'type'=> 'warning',
                    'status' => 409
    
                ]);
                return false;
            }
            else 
            {
                wishlists::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                  ]);
                $this->emit('wishlistAddedUpdated');
                session()->flash('message', 'Wishlist Added Successfuly');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Wishlist Added Successfuly',
                    'type'=> 'success',
                    'status' => 200
    
                ]);
            }
            
        } 
        else{
            session()->flash('message', 'Please Login To Continue');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to Continue',
                'type'=> 'info',
                'status' => 401 

            ]);
            return false;
        }

    }

    public function colorSelected($colorId)
    {
        $this->productColorId = $colorId;
        $productColor = $this->product->productColors()->where('_id', $colorId)->first();
    
        if ($productColor) {
            if ($productColor->quantity > 0) {
                $this->prodColorSelectedQuantity = $productColor->quantity;
            } else {
                $this->prodColorSelectedQuantity = 'outOfStock';
            }
        } else {
            $this->prodColorSelectedQuantity = null;
        }
    }
    



    public function incrementQuantity()
    {
        if($this->quantityCount < 10){
        $this->quantityCount++;
        } 
    }
    public function decrementQuantity()
    {
        if($this->quantityCount >  1){
        $this->quantityCount--;
        }
    }

    public function addToCart($productId)
    {
        if (Auth::check()) {
            // Check if the product exists and is available
            $product = Product::where('_id', $productId)->where('status', '0')->first();
    
            if (!$product) {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product does not exist or is unavailable',
                    'type' => 'warning',
                    'status' => 404
                ]);
                return;
            }
    
            // Check if the product has multiple colors
            if ($this->product->productColors()->count() > 1) {
                if ($this->prodColorSelectedQuantity != null) {
                    // Check if the product with the selected color is already in the cart
                    if (Cart::where('user_id', auth()->user()->id)
                        ->where('product_id', $productId)
                        ->where('product_color_id', $this->productColorId)
                        ->exists()) {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Product Already Added',
                            'type' => 'warning',
                            'status' => 200
                        ]);
                    } else {
                        $productColor = $this->product->productColors()->where('_id', $this->productColorId)->first();
    
                        if ($productColor->quantity > 0) {
                            if ($productColor->quantity >= $this->quantityCount) {
                                // Insert product to cart
                                Cart::create([
                                    "user_id" => auth()->user()->id,
                                    "product_id" => $productId,
                                    "product_color_id" => $this->productColorId,
                                    "quantity" => $this->quantityCount,
                                ]);
    
                                $this->emit('CartAddedUpadate');
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Product Added To Cart',
                                    'type' => 'success',
                                    'status' => 200
                                ]);
                            } else {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Only ' . $productColor->quantity . ' Quantity Available',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            }
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Out Of Stock',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    }
                } else {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Select Your Product Color',
                        'type' => 'info',
                        'status' => 404
                    ]);
                }
            } else {
                // For products without colors
                if (Cart::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Product Already Added',
                        'type' => 'warning',
                        'status' => 200
                    ]);
                } else {
                    if ($this->product->quantity > 0) {
                        if ($this->product->quantity >= $this->quantityCount) {
                            // Insert product to cart
                            Cart::create([
                                "user_id" => auth()->user()->id,
                                "product_id" => $productId,
                                "quantity" => $this->quantityCount,
                            ]);
    
                            $this->emit('CartAddedUpadate');
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Product Added To Cart',
                                'type' => 'success',
                                'status' => 200
                            ]);
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Only ' . $this->product->quantity . ' Quantity Available',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    } else {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Out Of Stock',
                            'type' => 'warning',
                            'status' => 404
                        ]);
                    }
                }
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login To Add To Cart',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }

    public function addToCartboth($productIds)
    {
        if (!Auth::check()) {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login To Add To Cart',
                'type' => 'info',
                'status' => 401
            ]);
            return;
        }
    
        $invalidProductMessage = null;
        $validProducts = [];
    
        // Validate all products before adding
        foreach ($productIds as $productId) {
            // Find product with MongoDB compatible query
            $product = Product::where('_id', new \MongoDB\BSON\ObjectId($productId))
                ->where('status', '0')
                ->first();
    
            if (!$product) {
                $invalidProductMessage = 'Product does not exist or is unavailable';
                break;
            }
    
            // Check if the product is already in the cart
            if (Cart::where('user_id', auth()->user()->_id)
                ->where('product_id', new \MongoDB\BSON\ObjectId($productId))
                ->exists()) {
                $invalidProductMessage = $product->name . ' is already in your cart';
                break;
            }
    
            // Auto-select the first available color if colors exist
            $productColorId = null;
    
            if (isset($product->productColors) && count($product->productColors) > 0) {
                // Get the first available color with quantity > 0
                $productColor = collect($product->productColors)
                    ->where('quantity', '>', 0)
                    ->first();
    
                if ($productColor) {
                    $productColorId = $productColor['_id']; // Assign the color ID if available
                } else {
                    $invalidProductMessage = 'No available colors for ' . $product->name;
                    break;
                }
            }
    
            // Stock availability check
            if ($productColorId) {
                // Check color stock if available
                if ($productColor['quantity'] < $this->quantityCount) {
                    $invalidProductMessage = 'Only ' . $productColor['quantity'] . ' quantity available for ' . $product->name;
                    break;
                }
            } else {
                // For products without color
                if ($product->quantity <= 0) {
                    $invalidProductMessage = $product->name . ' is out of stock';
                    break;
                } elseif ($product->quantity < $this->quantityCount) {
                    $invalidProductMessage = 'Only ' . $product->quantity . ' quantity available for ' . $product->name;
                    break;
                }
            }
    
            // Store valid product
            $validProducts[] = [
                'product' => $product,
                'colorId' => $productColorId,
            ];
        }
    
        // If any product is invalid, show error & stop process
        if ($invalidProductMessage) {
            $this->dispatchBrowserEvent('message', [
                'text' => $invalidProductMessage,
                'type' => 'warning',
                'status' => 404
            ]);
            return;
        }
    
        // Add all validated products to the cart
        foreach ($validProducts as $data) {
            Cart::create([
                "user_id" => auth()->user()->_id,
                "product_id" => $data['product']->_id,
                "product_color_id" => $data['colorId'] ? new \MongoDB\BSON\ObjectId($data['colorId']) : null,
                "quantity" => $this->quantityCount,
            ]);
        }
    
        $this->emit('CartAddedUpadate');
        $this->dispatchBrowserEvent('message', [
            'text' => 'Both products added to cart successfully',
            'type' => 'success',
            'status' => 200
        ]);
    }
    
    
    

   
   
   
   
   



    public function mount($category,$product){
         $this->category = $category;
         $this->procuvt = $product;
    }
    public function render()
    {
        $recommendedProducts = RecommendatProduct::where('product_id', $this->product->id)
        ->with('recommendedProduct')
        ->get();

        return view('livewire.frontend.product.view',[
            'category' => $this->category,
            'product' => $this->product,
            'recommendedProducts' => $recommendedProducts,

        ]);

    }
    
}
