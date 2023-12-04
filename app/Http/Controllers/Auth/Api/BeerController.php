<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BeerCreateRequest;
use App\Http\Requests\BeerUpdateRequest;
use App\Repositories\Contracts\BeerRepositoryInterface;
use Illuminate\Http\JsonResponse;

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
     * Store a newly created resource in storage.
     */
    public function store(BeerCreateRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $beer = $this->beerRepository->create($data);
            return response()->json($beer, 201);
        } catch (\Exception $error) {
            return response()->json(['Error on create beer' => $error], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $beer = $this->beerRepository->find($id);
            if (!$beer) {
                return response()->json(['message' => 'Beer not found'], 404);
            }
            return response()->json(['data' => $beer], 200);
        } catch (\Exception $error) {
            return response()->json(['Error on list beers' => 'Error:'.$error], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BeerUpdateRequest $request, string $id): JsonResponse
    {
        try {
            $data = $request->validated();
            $beer = $this->beerRepository->update($id, $data);
            if (!$beer) {
                return response()->json(['message' => 'beer not found to update.']);
            }
            return response()->json(['message' => 'Beer updated.']);
        } catch (\Exception $error) {
            return response()->json(['Error on edit beer' => 'Error:'.$error], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $beerDelete = $this->beerRepository->delete($id);
            if (!$beerDelete) {
                return response()->json(['message' => 'Beer not deleted.']);
            }
            return response()->json(['message' => 'Beer deleted.']);
        } catch (\Exception $error) {
            return response()->json(['error' => 'Error on delete beer: '.$error], 500);
        }
    }
}
