<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BeerCreateRequest;
use App\Http\Requests\BeerUpdateRequest;
use App\Http\StatusCodes\HttpStatusCode;
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
            $beerList = $this->beerRepository->paginate(10);
            return response()->json(['data' => $beerList], HttpStatusCode::HTTP_OK);
        } catch (\Exception $error) {
            return response()->json(
                ['error'=>'Error on list beers:'.$error->getMessage()],
                HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR
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
            return response()->json(['data' => $beer], HttpStatusCode::HTTP_CREATED);
        } catch (\Exception $error) {
            return response()->json(
                ['error'=>'Error on create beer:'.$error->getMessage()],
                HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR
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
                return response()->json(['message' => 'Beer not found'], HttpStatusCode::HTTP_NOT_FOUND);
            }
            return response()->json(['data' => $beer], HttpStatusCode::HTTP_OK);
        } catch (\Exception $error) {
            return response()->json(
                ['error' => 'Error on list beers:'.$error->getMessage()],
                HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR
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
                return response()->json(['message' => 'Beer not found to update.'], HttpStatusCode::HTTP_NOT_FOUND);
            }
            return response()->json(['message' => 'Beer updated.'], HttpStatusCode::HTTP_OK);
        } catch (\Exception $error) {
            return response()->json(
                ['error' => 'Error on edit beer:'.$error->getMessage()],
                HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR
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
                return response()->json(['message' => 'Beer not found.'], HttpStatusCode::HTTP_NOT_FOUND);
            }
            return response()->json(['message' => 'Beer deleted.'], HttpStatusCode::HTTP_NO_CONTENT);
        } catch (\Exception $error) {
            return response()->json(
                ['error' => 'Error on delete beer: '.$error],
                HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
