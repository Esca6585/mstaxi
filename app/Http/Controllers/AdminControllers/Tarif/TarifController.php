<?php

namespace App\Http\Controllers\AdminControllers\Tarif;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\TarifRequest;
use App\Models\Tarif;
use Image;
use Str;

class TarifController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $lang, $pagination = 10)
    {
        if($request->pagination) {
            $pagination = (int)$request->pagination;
        }

        $tarifs = Tarif::orderByDesc('id')->paginate($pagination);
        
        if(request()->ajax()){
            if($request->search) {
                $searchQuery = trim($request->query('search'));
                
                $requestData = ['name_tm', 'name_ru', 'minimum_price', 
                                'every_minute_price', 'every_km_price', 
                                'every_waiting_price', 'every_minute_price_outside', 
                                'every_km_price_outside', 'image'];
    
                $tarifs = Tarif::where(function($q) use($requestData, $searchQuery) {
                                        foreach ($requestData as $field)
                                        $q->orWhere($field, 'like', "%{$searchQuery}%");
                                })->paginate($pagination);
            }
            
            return view('admin-panel.tarif.tarif-table', compact('tarifs', 'pagination'))->render();
        }

        return view('admin-panel.tarif.tarif', compact('tarifs', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lang, Tarif $tarif)
    {
        return view('admin-panel.tarif.tarif-form', compact('tarif'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($lang, TarifRequest $request)
    {
        if($request->file('image')){
            $image = $request->file('image');
            
            $date = date("d-m-Y H-i-s");
            
            $fileRandName = Str::random(10);
            $fileExt = $image->getClientOriginalExtension();

            $fileName = $fileRandName . '.' . $fileExt;
            
            $path = 'assets/tarif/' . Str::slug($request->name_tm . '-' . $date ) . '/';

            $image->move($path, $fileName);
            
            $originalImage = $path . $fileName;
        }
        
        $tarif = new Tarif;
        
        $tarif->name_tm = $request->name_tm;
        $tarif->name_ru = $request->name_ru;
        $tarif->minimum_price = $request->minimum_price;
        $tarif->every_minute_price = $request->every_minute_price;
        $tarif->every_km_price = $request->every_km_price;
        $tarif->every_waiting_price = $request->every_waiting_price;
        $tarif->every_minute_price_outside = $request->every_minute_price_outside;
        $tarif->every_km_price_outside = $request->every_km_price_outside;
        $tarif->image = $originalImage ?? null;
        
        $tarif->save();
        
        return redirect()->route('tarif.index', [ app()->getlocale() ])->with('success-create', 'The resource was created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarif  $tarif
     * @return \Illuminate\Http\Response
     */
    public function show($lang, Tarif $tarif)
    {
        return view('admin-panel.tarif.tarif-show', compact('tarif'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarif  $tarif
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, Tarif $tarif)
    {
        return view('admin-panel.tarif.tarif-form', compact('tarif'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarif  $tarif
     * @return \Illuminate\Http\Response
     */
    public function update($lang, TarifRequest $request, Tarif $tarif)
    {
        if($request->file('image')){
            
            $this->deleteFolder($tarif);

            $image = $request->file('image');
            
            $date = date("d-m-Y H-i-s");
            
            $fileRandName = Str::random(10);
            $fileExt = $image->getClientOriginalExtension();

            $fileName = $fileRandName . '.' . $fileExt;
            
            $path = 'assets/Tarif/' . Str::slug($request->name_tm . '-' . $date . '-updated' ) . '/';

            $image->move($path, $fileName);
            
            $originalImage = $path . $fileName;

            $tarif->image = $originalImage;
        }

        $tarif->name_tm = $request->name_tm;
        $tarif->name_ru = $request->name_ru;
        $tarif->minimum_price = $request->minimum_price;
        $tarif->every_minute_price = $request->every_minute_price;
        $tarif->every_km_price = $request->every_km_price;
        $tarif->every_waiting_price = $request->every_waiting_price;
        $tarif->every_minute_price_outside = $request->every_minute_price_outside;
        $tarif->every_km_price_outside = $request->every_km_price_outside;
        
        $tarif->update();
        
        return redirect()->route('tarif.index', [ app()->getlocale() ])->with('success-update', 'The resource was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarif  $tarif
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, Tarif $tarif)
    {
        $this->deleteFolder($tarif);

        $tarif->delete();

        return redirect()->route('tarif.index', [ app()->getlocale() ])->with('success-delete', 'The resource was deleted!');
    }

    public function deleteFolder($tarif)
    {
        if($tarif->image){
            $folder = explode('/', $tarif->image);

            if($folder[2] != 'tarif-seeder'){
                \File::deleteDirectory($folder[0] . '/' . $folder[1] . '/' . $folder[2]);
            }
        }
    }
}
