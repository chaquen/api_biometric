<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use GuzzleHttp\Client;

use App\Util;

use DB;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       

     
        $e=DB::table("eventos")->get();

       
       
        //dd($response->getStatusCode());
        //var_dump($client);
        //dd(json_decode($response->getBody()->getContents()));

        //$fh = fopen("archivos/ppe.json", 'w');
        //fwrite($fh, $response->getBody()->getContents());
        


        if(count($e) > 0){
          return response()->json(array("mensaje"=>"","datos"=>$e,"respuesta"=>true));
        }else{
            //echo "archivo creado :).";
            //var_dump($response->getBody()->getContents());
            //return response()->json($response->getBody()->getContents());
            //fclose($fh);
            return response()->json(array("mensaje"=>"","datos"=>$e,"respuesta"=>false));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $e=DB::table("eventos")->where("id",$id)->get();

       
       
        //dd($response->getStatusCode());
        //var_dump($client);
        //dd(json_decode($response->getBody()->getContents()));

        //$fh = fopen("archivos/ppe.json", 'w');
        //fwrite($fh, $response->getBody()->getContents());
        


        if(count($e) > 0){
          return response()->json(array("mensaje"=>"","datos"=>$e,"respuesta"=>true));
        }else{
            //echo "archivo creado :).";
            //var_dump($response->getBody()->getContents());
            //return response()->json($response->getBody()->getContents());
            //fclose($fh);
            return response()->json(array("mensaje"=>"","datos"=>$e,"respuesta"=>false));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function mis_eventos(Request $request){
        //var_dump($request->get("datos"));
        $datos=json_decode($request->get("datos"));
        //  var_dump($datos);   
        //$client = new Client();
        //var_dump($datos->datos->usuario);
        
        /*$response = $client->request('POST', 'http://pdpmagdalenacentro.org/events',[
                'form_params' => [
                    'token' => 'iylC+Y1IKoEbdsAsUXIF+CU+fyn/hEnQg0hMfM0UWnTa05lrOOJExVJEYkyGoRfpYeu0vn/BxI5vcKdgkqZU7A==',
                    'id'=>$datos->datos->usuario->id,
                    'email_user'=>$datos->datos->usuario->email, 
                    'pass_user'=>$datos->datos->usuario->pass
                    
                ]
            ]);*/

        $da=DB::table("eventos")->where("id_ref",$datos->datos->usuario->id)->get();    


        //$da=json_decode($response->getBody()->getContents());
        //var_dump($da);
        return response()->json(["mensaje"=>"Eventos consultados ","respuesta"=>TRUE,"datos"=>$da]);
    }
}
