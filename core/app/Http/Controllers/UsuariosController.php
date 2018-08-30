<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use GuzzleHttp\Client;

use App\Util;

use DB;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $header=[
        'Accept' => 'application/json',
        'Authorization' => 'Bearer fgh1234568shzcmnbzxcb'
        ];    
        //$client = new Client(['base_uri' => 'http://pdpmagdalenacentro.org/api']);
        $client = new Client();
        
        $response = $client->request('POST', 'http://pdpmagdalenacentro.org/api',[
                'form_params' => [
                    'token' => 'jGffO7RLMaPnqZAt4zU7EUBj7w2qR5VVJHI7MLOZhv8p7z6sjP6baHk/7oKI2rSn1svXB5uQnPuzmrkDFJPDxQ=='
                    
                ]
            ]);
        

       
       
        //dd($response->getStatusCode());
        //var_dump($client);
        //dd(json_decode($response->getBody()->getContents()));

        $fh = fopen("archivos/pp.json", 'w');
        fwrite($fh, $response->getBody()->getContents());
        


        if($fh == false){
          die("No se ha podido crear el archivo.");
        }else{
            echo $response->getBody()->getContents();
            fclose($fh);
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
        
        return response()->json(["usuario"=>"Jose Alvarez","clave"=>"123","respuesta"=>true,"mensaje"=>"****"]);
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


    public function login(Request $request)
    {
        //
        $datos=Util::decodificar_json($request->get("datos"));
        //var_dump($datos);	
        $client = new Client();
        //190.3.194.207
        //pdpmagdalenacentro.org
        $response = $client->request('POST', 'http://pdpmagdalenacentro.org/api/user/',[
                'form_params' => [
                    'token' => 'jGffO7RLMaPnqZAt4zU7EUBj7w2qR5VVJHI7MLOZhv8p7z6sjP6baHk/7oKI2rSn1svXB5uQnPuzmrkDFJPDxQ==',
                   'email_user'=>trim($datos["datos"]->usuario), 
                    'pass_user'=>trim($datos["datos"]->pass)
                    
                ]
            ]);

        //var_dump($response->getBody()->getContents());

        $da=json_decode($response->getBody()->getContents());
        
        if(gettype($da)=="array"){
            // se realiza registro o actualizacion del usuario que inicio contacto
            foreach ($da as $key => $v) {
                //var_dump($v);
                $ar=(array)$v;

                if($v->email==$datos["datos"]->usuario && $v->pass==$datos["datos"]->pass){
                    $c=count(DB::table("users")->where("email",$v->email)->get());
                    if($c==0){
                        DB::table("users")->insert($ar);
                        return response()->json(["mensaje"=>"Bienvenido ".$v->name,"respuesta"=>TRUE,"datos"=>$v,"redireccionar"=>"menuEventos.html"]);
                    }else{
                        DB::table("users")->where("email",$v->email)->update($ar);
                        return response()->json(["mensaje"=>"Bienvenido ".$v->name,"respuesta"=>TRUE,"datos"=>$v,"redireccionar"=>"menuEventos.html"]);
                    }

                    
                }
            }
        }else{
            if(property_exists($da, "state") ){
                if($da->state=="0"){
                    return response()->json(["mensaje"=>"No se envió token de seguridad","respuesta"=>false]);
                }
            }
            if(property_exists($da, "state") ){
                if($da->state=="1"){
                    return response()->json(["mensaje"=>"El token de seguridad no es valido","respuesta"=>false]);
                }
            }
            if(property_exists($da, "state") ){
                if($da->state=="2"){
                    return response()->json(["mensaje"=>"Falta un dato del usuario","respuesta"=>false]);
                }
            }
            if(property_exists($da, "state") ){
                if($da->state=="3"){
                    return response()->json(["mensaje"=>"Usuario no existe","respuesta"=>false]);
                }
            }
            if(property_exists($da, "state") ){
                if($da->state=="4"){
                    return response()->json(["mensaje"=>"Contraseña incorrecta del usuario","respuesta"=>false]);
                }
            }
        }
          
        
    }
    

    


}
