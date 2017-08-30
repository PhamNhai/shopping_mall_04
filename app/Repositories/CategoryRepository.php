<?php

namespace App\Repositories;

use Auth;
use Log;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Contracts\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function productCount(){
        $counts = Product::all() -> count();
        return $counts;
    }

    public function getComments($product_id)
    {
        $comments = Comment::where('product_id', $product_id)
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        return $comments;
    }

    public function getProducts($product_id){
        $product = Product::findOrFail($product_id);
        return $product;
    }

    public function getOrder($product_id){
        $order = Order::orderBy('order_id','desc')->first();
        return $order;
    }

    public function newArrivals(){
        $newArrivals = Product::orderBy('products.created_at')
                        ->paginate(3);
        return $newArrivals;
    }

    public function topSells(){
        $topSells = Product::orderBy('products.top_product')
                    ->paginate(6);
        return $topSells;
    }
}
