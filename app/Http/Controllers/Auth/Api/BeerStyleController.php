<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BeerStyleCreateRequest;
use App\Http\Requests\BeerStyleUpdateRequest;
use App\Http\StatusCodes\HttpStatusCode;
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
            $beerStyleList = $this->beerStyleRepository->paginate(10);
            return response()->json(['data' => $beerStyleList], HttpStatusCode::HTTP_OK);
        } catch (\Exception $error) {
            return response()->json(
                ['error' => 'Error on get beer styles: '.$error->getMessage()],
                HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR
            );
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
            return response()->json(['data' => $beerStyle], HttpStatusCode::HTTP_OK);
        } catch (\Exception $error) {
            return response()->json(
                ['error' => 'Error on create beer style:'.$error->getMessage()],
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
            $beerStyle = $this->beerStyleRepository->find($id);
            if (!$beerStyle) {
                return response()->json(['message' => 'Beer style not found'], HttpStatusCode::HTTP_NOT_FOUND);
            }
            return response()->json(['data' => $beerStyle], HttpStatusCode::HTTP_OK);
        } catch (\Exception $error) {
            return response()->json(
                ['error' => 'Error on list beer styles:'.$error->getMessage()],
                HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR
            );
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
                return response()->json(
                    ['message' => 'Beer style not found to update.'],
                    HttpStatusCode::HTTP_NOT_FOUND
                );
            }
            return response()->json(['message' => 'Beer style updated.'], HttpStatusCode::HTTP_OK);
        } catch (\Exception $error) {
            return response()->json(
                ['error' => 'Error on edit beer style:'.$error->getMessage()],
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
            $beerStyle = $this->beerStyleRepository->find($id);
            if ($beerStyle->beers()->count() > 0) {
                return response()->json(
                    [
                        'message'
                        => 'This beer style can´t be deleted. There are beers linked to this style.'
                    ],
                    HttpStatusCode::HTTP_CONFLICT
                );
            }
            $deletedBeerStyle  = $this->beerStyleRepository->delete($id);
            if (!$deletedBeerStyle) {
                return response()->json(['message' => 'Beer style not found.'], HttpStatusCode::HTTP_NOT_FOUND);
            }
            return response()->json(['message' => 'Beer style deleted.'], HttpStatusCode::HTTP_NO_CONTENT);
        } catch (\Exception $error) {
            return response()->json(
                ['error'  => 'Error on delete beer style:'.$error->getMessage()],
                HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
