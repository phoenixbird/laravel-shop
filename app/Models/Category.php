<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'is_directory',
        'level',
        'path'
    ];
    protected $casts = [
        'is_directory' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        //监听Category创建事件，用于初始化level和path字段值
        static::creating(function (Category $category) {
            //如果创建的是一个根目录类
            if (is_null($category->parent_id)) {
                //将层级设为0
                $category->level = 0;
                $category->path = '-';
            } else {
                //将层级设为父类目录的层级+1
                $category->level = $category->parent->level + 1;
                $category->path = $category->parent->path . $category->parent_id . '-';
            }
        });
    }

    //与自己的父类关联
    public function parent(){
        return $this->belongsTo(Category::class);
    }

    public function children(){
        return $this->hasMany(Category::class,'parent_id');
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    //定义一个访问器，获取所有祖先类目的ID
    public function getPathIdsAttribute(){
        return array_filter(explode('-',trim($this->path,'-')));
    }

    //定义一个访问器，获取所有祖先类目并按层级排序
    public function getAncestorsAttribute(){
        return Category::query()
            ->whereIn('id',$this->path_ids)
            ->orderBy('level')
            ->get();
    }

    //定义一个访问器，获取以‘-’为分隔的所有祖先类目名称以及当前类目的名称
    public function getFullNameAttribute(){
        return $this->ancestors
            ->pluck('name')
            ->push($this->name)
            ->implode('-');
    }
}
