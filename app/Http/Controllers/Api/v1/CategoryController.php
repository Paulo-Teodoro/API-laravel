<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryFormRequest;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    private $category;
    private $totalPage = 10;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category, Request $request)
    {
        $categories = $this->category->getResults($request->name);

        return $categories;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCategoryFormRequest $request)
    {
        $category = $this->category->create($request->all());
    
        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$category = $this->category->find($id))
            return response()->json(['error' => 'Categoria não encontrada'], 404);

        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCategoryFormRequest $request, $id)
    {
        if(!$category = $this->category->find($id)) {
            return response()->json(['error' => 'Categoria não encontrada'], 404);
        }
        
        $category->update($request->all());

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$category = $this->category->find($id)){
            return response()->json(['error' => 'Categoria não encontrada'], 404);
        }

        $category::destroy();

        return response()->json(['Success' => true], 204);
    }

    public function delete($id)
    {
        if(!$category = $this->category->find($id)){
            return response()->json(['error' => 'Categoria não encontrada'], 404);
        }

        $category->delete();

        return response()->json(['Success' => true], 204);
    }

    public function products($id) {
        // if(!$category = $this->category->with(['products'])->find($id)){
        //     return response()->json(['error' => 'Categoria não encontrada'], 404);
        // }
        //$products = $category->products;

        if(!$category = $this->category->find($id)){
            return response()->json(['error' => 'Categoria não encontrada'], 404);
        }

        $products = $category->products()->paginate($this->totalPage);

        return response()->json([
            'category' => $category,
            'products' => $products
        ]);
    }
}
