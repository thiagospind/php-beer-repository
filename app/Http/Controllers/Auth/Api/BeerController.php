<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BeerRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BeerController extends Controller
{
    protected BeerRepositoryInterface $beerRepository;
    public function __construct(BeerRepositoryInterface $model)
    {
        $this->beerRepository = $model;
    }

    /**
     * Display a listing of the resource.
     */

    public function index(): JsonResponse
    {
        try {
            $beerList = $this->beerRepository->all();
            return response()->json(['data' => $beerList], 200);
        } catch (\Exception $error) {
            return response()->json(['Error on list beers' => 'Error:'.$error], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse
    {
        try {
            $beerList = $this->beerRepository->c();
            return response()->json(['data' => $beerList], 200);
        } catch (\Exception $error) {
            return response()->json(['Error on list beers' => $error], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
