<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SlideAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Slide::orderBy('id', 'desc')->get();

        $tab = [];
        foreach ($data as $el) {
            $o = (object) $el->toArray();
            $o->date = $el->date?->format('d-m-Y H:i:s');
            $tab[] = $o;
        }
        return $tab;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'title' => 'sometimes|max:100',
            'text' => 'sometimes|max:450',
            'file' => 'required|mimes:png,jpg,jpeg,gif|max:1500',
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();
        $data['file'] = request('file')->store('slides', 'public');
        $data['date'] = now('Africa/Lubumbashi');
        Slide::create($data);
        return response([
            'success' => true,
            'message' => "Slide créé avec succès."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $slide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slide $slide)
    {
        $validator = Validator::make(request()->all(), [
            'title' => 'sometimes|max:100',
            'text' => 'sometimes|max:450',
            'file' => 'sometimes|mimes:png,jpg,jpeg,gif|max:1500',
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();
        $data['date'] = now('Africa/Lubumbashi');
        if (request()->has('file')) {
            $data['file'] = request('file')->store('slides', 'public');
            File::delete('storage/' . $slide->file);
        }
        $slide->update($data);
        return response([
            'success' => true,
            'message' => "Slide mis à jour avec succès.."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        File::delete('storage/' . $slide->file);
        $slide->delete();
        return response([
            'success' => true,
            'message' => "Slide supprimé avec succès."
        ]);
    }
}
