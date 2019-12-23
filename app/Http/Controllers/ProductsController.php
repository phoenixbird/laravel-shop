<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidRequestException;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Services\CategoryService;

class ProductsController extends Controller
{
    public function index(Request $request,CategoryService $categoryService)
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

        //如果传入有category_id字段，并且在数据库中有对应的类目
        if($request->input('category_id') &&
        $category=Category::find($request->input('category_id'))){
            if($category->is_directory){
                //如果这个类目是父类目则筛选出此类目下所有的商品
                $builder->whereHas('category',function ($query)use ($category){
                    $query->where('path','like',$category->path.$category->id.'-%');
                });
            }else{
                $builder->where('category_id', $category->id);
            }
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
            'category' => $category ?? null,
            'categoryTree' => $categoryService->getCategoryTree(),
        ]);
    }

    //商品详情页显示
    public function show(Product $product, Request $request)
    {
        //判断商品是否已经上架，如果没上架抛出异常
        if (!$product->on_sale) {
            throw new InvalidRequestException('商品为上架');
        }
        $favored = false;
        if ($user = $request->user()) {
            //从当前用户已收藏的商品中搜索ID为当前商品id的商品
            // boolval()函数把值转化为布尔值
            $favored = boolval($user->favoriteProducts()->find($product->id));
        }
        $reviews = OrderItem::query()
            ->with(['order.user', 'productSku'])
            ->where('product_id', $product->id)
            ->whereNotNull('reviewed_at')
            ->orderBy('reviewed_at', 'desc')
            ->limit(10)
            ->get();
        return view('products.show', [
            'product' => $product,
            'favored' => $favored,
            'reviews' => $reviews,
        ]);
    }

    //收藏商品
    public function favor(Product $product, Request $request)
    {
        $user = $request->user();
        if ($user->favoriteProducts()->find($product->id)) {
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

    //商品收藏列表
    public function favorites(Request $request)
    {
        $products = $request->user()->favoriteProducts()->paginate(16);

        return view('products.favorites', ['products' => $products]);
    }
}
