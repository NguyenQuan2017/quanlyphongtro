<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeopleRequest;
use App\Http\Resources\PeopleResource;
use App\Models\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->successResponse(People::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PeopleRequest $request)
    {
        $data = $request->validated();
        $data['date_of_birth'] = date('Y-m-d',strtotime(str_replace(array('.', '/'), '-', $data['date_of_birth'])));
        $peoples = People::create($data);
        if ($peoples) {
            return $this->successResponse([],'success',201);
        }
        return $this->errorResponse('Create fails',500);
    }

    /**
     * Display the specified resource.
     *
     * @param People $people
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(People $people)
    {
        $data = new PeopleResource($people);
        $data['date_of_birth'] = date('d/m/Y', strtotime($data['date_of_birth']));
        return $this->successResponse($data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param PeopleRequest $request
     * @param People $people
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PeopleRequest $request, People $people)
    {
        $data = $request->validated();
        $data['date_of_birth'] = date('Y-m-d',strtotime(str_replace(array('.', '/'), '-', $data['date_of_birth'])));

        $peoples = $people->update($data);
        if ($peoples) {
            return $this->successResponse([],'success',201);
        }
        return $this->errorResponse('Updated fails',500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param People $people
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(People $people)
    {
        $people->delete();
        return $this->successResponse([],'success');
    }
}
