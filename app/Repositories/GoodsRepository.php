<?php

namespace App\Repositories;

use App\Models\Good;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class GoodsRepository
{
    public function getGoods(Request $request): LengthAwarePaginator
    {
        $query = Good::with(['characteristics', 'stocks'])
            ->where('is_published', true);

        if ($request->has('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->has('stock_id')) {
            $query->whereHas('stocks', function ($query) use ($request) {
                $query->where('id', $request->input('stock_id'));
            });
        }


        if ($request->has('price_min') && $request->has('price_max')) {
            $priceMin = $request->input('price_min');
            $priceMax = $request->input('price_max');
            $query->whereRaw("CAST(JSON_UNQUOTE(JSON_EXTRACT(prices, '$.price')) AS DECIMAL(10,2)) BETWEEN ? AND ?", [$priceMin, $priceMax]);
        }


        if ($request->has('characteristics')) {
            foreach ($request->input('characteristics') as $name => $value) {
                $query->whereHas('characteristics', function ($query) use ($name, $value) {
                    $query->where('name', $name)->where('value', $value);
                });
            }
        }

        if ($request->has('sort_by_name')) {
            $query->orderBy('name', $request->input('sort_by_name'));
        }

        $perPage = $request->input('per_page', 14);
        $goods = $query->paginate($perPage);

        if ($request->has('fields')) {
            $fields = explode(',', $request->input('fields'));
            $goods->getCollection()->transform(function ($item) use ($fields) {
                return $item->only($fields);
            });
        }

        return $goods;
    }

}
