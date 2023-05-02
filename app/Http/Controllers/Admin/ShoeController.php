<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shoe;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ShoeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // mostra tutti senza pagination 
        // $shoes = Shoe::all();


        // search function and paginate 
        if($request->has('term')){
            $term = $request->get('term');
            // search + paginate
            $shoes = Shoe::orderBy('updated_at', 'DESC')->where('name', 'LIKE', "%$term%")->paginate(10)->withQueryString(); 
        }else{
            // only paginate 
            $shoes = Shoe::orderBy('updated_at', 'DESC')->paginate(15);
        }


        $sort = (!empty($sort_request = $request->get('sort'))) ? $sort_request : 'updated_at';
        $order = (!empty($order_request = $request->get('order'))) ? $order_request : 'DESC';
        return view('Admin.Shoe.index', compact('shoes', 'sort', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Shoe.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $data = $request->all();


        // salvo e creo il path per poi salvarlo 
        if(Arr::exists($data, 'img')) {
            $path = Storage::put('uplodas/shoes', $data['img']);
            
        };

    
        $shoe = new Shoe;
        $shoe -> fill($this->validation($data));
        $shoe-> img = $path; //salvo il path
        $shoe ->save();

        // redirect standard alla show 
        // return redirect() -> route('Admin.Shoe.show', $shoe);

        // redirect con route alla show ma con la variabile flash per successo  creazione 
        return to_route('Admin.Shoe.show', $shoe)
            ->with('message_content',"La scarpa $shoe->name è stata creata con successo" );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function show(Shoe $Shoe)
    {
        return view('Admin.Shoe.show', compact('Shoe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function edit(Shoe $Shoe)
    {
        return view('Admin.Shoe.edit', compact('Shoe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shoe $Shoe)
    {   

        $data = $this->validation($request->all());
        

        $Shoe->update($data);

        // return redirect ()->route('Admin.Shoe.show', $Shoe);


        // redirect con route alla show ma con la variabile flash per successo  modifica
        return to_route('Admin.Shoe.show', $Shoe)
            ->with('message_content',"La scarpa $Shoe->name è stata modificata con successo" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shoe $Shoe)
    {   
        $id_shoe = $Shoe->name;
        $Shoe->delete();

        // return redirect ()->route('Admin.Shoe.index');


        // redirect con route alla all'index ma con la variabile flash per successo  cancellazione
        return to_route('Admin.Shoe.index')
            ->with('message_type',"danger" )
            ->with('message_content',"La scarpa $id_shoe è stata eliminate con successo" );
    }

    private function validation($data) {
        $validate = Validator::make(
            $data, //dati del form da validare
            [
            'name' => 'required|string|max:50',
            'brand'=> 'required|string|max:50', 
            'size'=> 'required|integer',
            'price'=> 'required',
            'type'=> 'required|string|in:elegant,sportive,casual',
            'img'=> 'nullable|image|mimes:jpg,png,jpeg'
            ],
            [
            // require message 
            'name.required'=> 'Il nome della scarpa è obbligatorio',
            'brand.required'=> "Il nome dell'brand è obbligatorio",
            'size.required'=> "È necessario inseriere la misura della scarpa",
            'price.required'=> "È necessario inseriere il prezzo della scarpa",
            'type.required'=> "Il tipo di scarpa è obbligatorio",

            // max char message
            'name.max'=> 'Il nome della scarpa non puo superare i 50 caratteri',
            'brand.max'=> "il nome del brand non puo superare i 50 caratteri",

            // enum message 
            'type.in'=> 'devi scegliere tra elegante, sportivo o casual',

            // prise decimal message 
            'price.required'=> 'Il nome della scarpa è obbligatorio',

            // type valid image error 
            'img.image'=> "Il file deve essere un' immagine ",
            'img.mimes'=> "Estensione errata, scegli tra: jpg, png, jpeg",


            ]

        )->validate();
        
        return $validate;
    }

    public function trash(){

        $shoes = Shoe::onlyTrashed()->orderBy('deleted_at', 'DESC')->paginate(15)->withQueryString();
        

        return view('Admin.shoe.trash', compact('shoes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(Int $id)
    {   
        $shoe = Shoe::where('id' , $id)->onlyTrashed()->first();

        dd($shoe);

        $id_shoe = $shoe->name;
        $shoe->forceDelete();


        // redirect con route alla all'index ma con la variabile flash per successo  cancellazione
        return to_route('Admin.shoe.trash')
            ->with('message_type',"danger" )
            ->with('message_content',"La scarpa $id_shoe è stata eliminata definitivamnte" );
    }
}
