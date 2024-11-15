<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Validator;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Video::all();

        return response()->json([
            "status" => true,
            "message" => "Get Data Success",
            "data" => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "source" => "required"
        ]);


        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => "Can't Upload Video Source",
                "error" => $validator->errors()
            ], 422);
        }


        Video::create($request->all());

        return response()->json([
            "status" => true,
            "message" => "data Successfully Created",
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


        $data = Video::find($id);


        if(empty($data)) {
            return response()->json([
                "status" => false,
                "message" => "Can't found Data",
            ], 404);
        }


        return response()->json([
            "status" => true,
            "message" => "Data Appeared",
            "data" => $data
        ]);




    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "source" => "required"
        ]);


        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => "Can't Update Video Source",
                "error" => $validator->errors()
            ], 422);
        }


       $video = Video::findOrFail($id)->update($request->all());


       if(empty($video)) {
        return response()->json([
            "status" => false,
            "message" => "video Not Found"
        ], 404);
       }


        return response()->json([
            "status" => true,
            "message" => "data Successfully Updated",
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Video::destroy($id);

        return response()->json([
            "status" => true,
            "message" => "successfully Delete Data"
        ]);
    }
}
