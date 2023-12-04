<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BeerStyleCreateRequest;
use App\Http\Requests\BeerStyleUpdateRequest;
use App\Repositories\Contracts\BeerStyleRepositoryInterface;
use Illuminate\Http\JsonResponse;


class BeerStyleController extends Controller
{

    protected BeerStyleRepositoryInterface $beerStyleRepository;
    public function __construct(BeerStyleRepositoryInterface $model)
    {
        $this->beerStyleRepository = $model;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $beerStyleList = $this->beerStyleRepository->all();
            return response()->json(['data' => $beerStyleList], 200);
        } catch (\Exception $error) {
            return response()->json(['Error on list beer styles' => 'Error:'.$error], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BeerStyleCreateRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $beerStyle = $this->beerStyleRepository->create($data);
            return response()->json($beerStyle, 201);
        } catch (\Exception $error) {
            return response()->json(['Error on create beer style' => $error], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $beerStyle = $this->beerStyleRepository->find($id);
            if (!$beerStyle) {
                return response()->json(['message' => 'Beer style not found'], 404);
            }
            return response()->json(['data' => $beerStyle], 200);
        } catch (\Exception $error) {
            return response()->json(['Error on list beer styles' => 'Error:'.$error], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BeerStyleUpdateRequest $request, string $id): JsonResponse
    {
        try {
            $data = $request->validated();
            $beerStyle = $this->beerStyleRepository->update($id, $data);
            if (!$beerStyle) {
                return response()->json(['message' => 'Beer style not found to update.']);
            }
            return response()->json(['message' => 'Beer style updated.']);
        } catch (\Exception $error) {
            return response()->json(['Error on edit beer style' => 'Error:'.$error], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $beerStyle = $this->beerStyleRepository->delete($id);
            if (!$beerStyle) {
                return response()->json(['message' => 'Beer style not deleted.']);
            }
            return response()->json(['message' => 'Beer style deleted.']);
        } catch (\Exception $error) {
            return response()->json(['Error on delete beer style:'  => 'Error:'.$error], 500);
        }
    }
}
