<?php

namespace App\Http\Services;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryService
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAll()
    {
        return $this->category->all();
    }

    public function getOne($id)
    {
        return $this->category->find($id);
    }

    public function create($request)
    {
        return $this->category->create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);
    }

    public function update($request, $id)
    {
        $category = $this->getOne($id);
        $category->update([
            'name' => $request->name ?? $category->name,
            'description' => $request->description ?? $category->description,
            'slug' => Str::slug($request->name) ?? $category->slug
        ]);
        return $category;
    }
    public function delete($id)
    {
        $category = $this->getOne($id);
        $category->delete();
    }

}
