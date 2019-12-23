<?php
namespace App\Http\ViewComposers;


use App\Services\CategoryService;
use Illuminate\View\View;

class CategoryTreeComposer{
    protected $categoryService;

    //依赖注入，自动注入CategoryService类
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService=$categoryService;
    }

    //当渲染指定模板时候，laravel会用compose方法调用指定模板
    public function compose(View $view){
        //这里使用with方法
        $view->with('categoryTree',$this->categoryService->getCategoryTree());
    }
}