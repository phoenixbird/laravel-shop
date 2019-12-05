<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidRequestException;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        // 创建一个查询构造器
        $builder = Product::query()->where('on_sale', 1);
        //判断是否提交search参数，如果有就赋值给$search变量
        //$search参数用来模糊搜索商品
        if ($search = $request->input('search', '')) {
            $like = '%' . $search . '%';
            // 模糊搜索商品标题、商品详情、SKU 标题、SKU描述
            $builder->where(function ($query) use ($like) {
                $query->where('title', 'like', $like)
                    ->orWhere('description', 'like', $like)
                    ->orWhereHas('skus', function ($query) use ($like) {
                        $query->where('title', 'like', $like)
                            ->orWhere('description', 'like', $like);
                    });
            });
        }

        //判断是否提交order参数，如果有就赋值给$order变量,$order参数用来控制商品排序规则
        if ($order = $request->input('order', '')) {
            // 是否是以 _asc 或者 _desc 结尾
            if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)) {
                // 如果字符串的开头是这 3 个字符串之一，说明是一个合法的排序值
                if (in_array($m[1], ['price', 'sold_count', 'rating'])) {
                    // 根据传入的排序值来构造排序参数
                    $builder->orderBy($m[1], $m[2]);
                }
            }
        }

        $products = $builder->paginate(16);

        return view('products.index', [
            'products' => $products,
            'filters' => [
                'search' => $search,
                'order' => $order,
            ],
        ]);
    }

    //商品详情页显示
    public function show(Product $product,Request $request){
        //判断商品是否已经上架，如果没上架抛出异常
        if(!$product->on_sale){
            throw new InvalidRequestException('商品为上架');
        }
        $favored=false;
        if($user=$request->user()){
            //从当前用户已收藏的商品中搜索ID为当前商品id的商品
            // boolval()函数把值转化为布尔值
            $favored=boolval($user->favoriteProducts()->find($product->id));
        }
        return view('products.show', ['product' => $product, 'favored' => $favored]);
    }

    //收藏商品
    public function favor(Product $product,Request $request){
        $user=$request->user();
        if($user->favoriteProducts()->find($product->id)){
            return [];
        }
        //如果已经收藏则不做任何操作直接返回，否则通过 attach() 方法将当前用户和此商品关联起来
        $user->favoriteProducts()->attach($product);
        return [];
    }

    //取消收藏商品
    public function disfavor(Product $product, Request $request)
    {
        $user = $request->user();
        $user->favoriteProducts()->detach($product);

        return [];
    }
}
