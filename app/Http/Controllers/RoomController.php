<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\People;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = Room::with('peoples')->get()->sortBy('name')->values()->all();
        return $this->successResponse($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoomRequest $request)
    {
        $data = $request->validated();
        $rooms = Room::create($data);
        if($rooms) {
            return $this->successResponse([],'success',201);
        }
        return $this->errorResponse('Create fails',500);
    }

    /**
     * Display the specified resource.
     *
     * @param Room $room
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Room $room)
    {
        $data = new RoomResource($room);
        return $this->successResponse($data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param RoomRequest $request
     * @param Room $room
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RoomRequest $request, Room $room)
    {
        $rooms = $room->update($request->validated());
        if($rooms) {
            return $this->successResponse([],'success',201);
        }
        return $this->errorResponse('Updated fails',500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Room $room
     * @param People $people
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return $this->successResponse([],'success');
    }
}
