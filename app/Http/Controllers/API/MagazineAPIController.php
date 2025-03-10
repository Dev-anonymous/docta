<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Magazine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MagazineAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Magazine::query();
        if (request()->has('datatable')) {

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn = <<<STR
                            <div>
                                <button type='button' value="$row->id" bdel class="btn btn-sm btn-outline-danger mr-2 text-nowrap"><i class="fa fa-trash"></i></button>
                            </div>
                        STR;

                    return $actionBtn;
                })
                ->editColumn('fichier', function ($row) {
                    if (empty($row->fichier)) return '-';
                    $href = asset('storage/' . $row->fichier);
                    return "<a href='$href' target='_blanck' class='btn btn-link'><i class='fa fa-file-pdf-o'></i> Fichier</a>";
                })->editColumn('image', function ($row) {
                    $href = asset('storage/' . $row->image);
                    return "<img src='$href' class='img-thumbnail' style='width:80px;'/>";
                })
                ->editColumn('categoriemagazine_id', function ($row) {
                    return $row->categoriemagazine->categorie;
                })

                ->editColumn('date', function ($row) {
                    return  $row->date?->format('d-m-Y');
                })->editColumn('datepublication', function ($row) {
                    return  $row->datepublication?->format('d-m-Y H:i:s');
                })
                ->rawColumns(['action', 'image', 'fichier', 'date'])
                ->make(true);
        }

        $data = $data->paginate();

        return response()->json([
            'success' => true,
            'message' => 'Convoys retrieved successfully',
            'data' => $data
        ], 200);
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
            'categoriemagazine_id' => 'required|exists:categoriemagazine,id',
            'date' => 'required|date',
            'titre' => 'required|max:100',
            'description' => 'required|max:255',
            'text' => 'sometimes',
            'fichier' => 'sometimes|mimes:pdf',
            'image' => 'required|mimes:png,jpg,jpeg|dimensions:min_width=500,min_height=300,max_width=1000,max_height=500',
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();
        if (request('fichier')) {
            $data['fichier'] = request('fichier')->store('magazinefiles', 'public');
        }
        $data['image'] = request('image')->store('magazines', 'public');
        $data['datepublication'] = nnow();
        Magazine::create($data);
        return response([
            'success' => true,
            'message' => "Magazine créé avec succès."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Magazine  $magazine
     * @return \Illuminate\Http\Response
     */
    public function show(Magazine $magazine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Magazine  $magazine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Magazine $magazine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Magazine  $magazine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Magazine $magazine)
    {
        $magazine->delete();
        File::delete('storage/' . $magazine->fichier);
        File::delete('storage/' . $magazine->image);
        return response()->json([
            'success' => true,
            'message' => 'Magazine supprimé.'
        ], 200);
    }
}
