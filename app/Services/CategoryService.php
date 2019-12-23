<?php
namespace App\Services;

use App\Models\Category;

class CategoryService{
    public function getCategoryTree($parentId=null,$allCategories=null){
        if(is_null($allCategories)){
            $allCategories=Category::all();
        }

        return $allCategories->where('parent_id',$parentId)
            ->map(function (Category $category)use($allCategories){
                $data=['id'=>$category->id,'name'=>$category->name];
                //如果当前不是父类目录
                if(!$category->is_directory){
                    return $data;
                }
                //当前目录是父类目录,则增加一个children字段
                $data['children']=$this->getCategoryTree($category->id,$allCategories);

                return $data;
            });

    }
}