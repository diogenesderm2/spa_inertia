<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = auth()->user()
            ->products()

            ->with('category')
            ->where(function ($query) {
                if ($search = request()->search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhereHas('category', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        });
                }
            })
            ->when(!request()->query('sort_by'), function ($query) {
                $query->latest();
            })
            ->when(request()->query('sort_by'), function ($query) {
                $sortBy = request()->query('sort_by');
                $field = ltrim($sortBy, '-');
                $direction =  substr($sortBy, 0, 1) === '-' ? 'desc' : 'asc';
                $query->orderBy($field, $direction);
            })
            ->paginate(12)
            ->withQueryString();

        return Inertia::render('Product/Index', [
            'products' => ProductResource::collection($products),
            'query' => (object) request()->query(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Product/Create', [
            'categories' => CategoryResource::collection(Category::orderBy('name')->get()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        dd($request->validated());
        $request->user()->products()->create($request->validated());

        return redirect()
            ->route('products.index')
            ->with('message', 'Produto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return Inertia::render('Product/Show', [
            'product' => ProductResource::make($product),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return Inertia::render('Product/Edit', [
            'product' => ProductResource::make($product),
            'categories' => CategoryResource::collection(Category::orderBy('name')->get()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()
            ->route('products.index')
            ->with('message', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()
            ->route('products.index')
            ->with('message', 'Produto excluído com sucesso!');
    }
}
