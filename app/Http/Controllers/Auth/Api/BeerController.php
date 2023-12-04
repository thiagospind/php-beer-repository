<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BeerCreateRequest;
use App\Http\Requests\BeerUpdateRequest;
use App\Repositories\Contracts\BeerRepositoryInterface;
use config\HttpStatusCodes;
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
            return response()->json(
                ['message'=>'Error on list beers:'.$error->getMessage()],
                HttpStatusCodes::HTTP_INTERNAL_SERVER_ERROR
            );
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
            return response()->json(['data' => $beer], HttpStatusCodes::HTTP_CREATED);
        } catch (\Exception $error) {
            return response()->json(
                ['error'=>'Error on create beer:'.$error->getMessage()],
                HttpStatusCodes::HTTP_INTERNAL_SERVER_ERROR
            );
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
                return response()->json(['message' => 'Beer not found'], HttpStatusCodes::HTTP_NOT_FOUND);
            }
            return response()->json(['data' => $beer], HttpStatusCodes::HTTP_OK);
        } catch (\Exception $error) {
            return response()->json(
                ['error' => 'Error on list beers:'.$error->getMessage()],
                HttpStatusCodes::HTTP_INTERNAL_SERVER_ERROR
            );
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
                return response()->json(['message' => 'beer not found to update.'], HttpStatusCodes::HTTP_NOT_FOUND);
            }
            return response()->json(['message' => 'Beer updated.'], HttpStatusCodes::HTTP_OK);
        } catch (\Exception $error) {
            return response()->json(
                ['error' => 'Error on edit beer:'.$error->getMessage()],
                HttpStatusCodes::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $deleteBeer = $this->beerRepository->delete($id);
            if (!$deleteBeer) {
                return response()->json(['message' => 'Beer not found.'], HttpStatusCodes::HTTP_NOT_FOUND);
            }
            return response()->json(['message' => 'Beer deleted.'], HttpStatusCodes::HTTP_NO_CONTENT);
        } catch (\Exception $error) {
            return response()->json(
                ['error' => 'Error on delete beer: '.$error],
                HttpStatusCodes::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
