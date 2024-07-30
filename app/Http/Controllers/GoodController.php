<?php

namespace App\Http\Controllers;

use App\Http\Resources\Good\GoodResource;
use App\Models\Good;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GoodController extends Controller
{
    protected GoodsRepository $repository;
    public function __construct(GoodsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $goods = $this->repository->getGoods($request);
        return GoodResource::collection($goods);
    }

    public function show(Request $request, Good $good): GoodResource
    {
        $good->load(['characteristics', 'stocks']);
        return new GoodResource($good);
    }
}
