<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use GuzzleHttp\Client;

use App\Util;

use DB;

use Carbon\Carbon;
use DateTimeZone;


class ParticipantesController extends Controller
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
            echo "archivo creado";
            fclose($fh);
        }
        // {"type":"User"...' 

        //return response()->json(["email"=>

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
        //$datos=Util::decodificar_json($request->get("datos"));
        $datos=json_decode($request->get("datos"));
        //var_dump(json_decode($datos));
        //var_dump($datos->datos->datos);
        $arr=[];
        $i=0;
       foreach ($datos->datos->datos as $key => $value) {
        //var_dump($key);
        //var_dump($value);
        if($key=="id"){
            /*$dat=DB::table("participantes")->where("documento",$value)->get();
            if(count($dat)==0){
                $arr=(array)$datos["datos"]; 
                break;   
                $i++;
            }*/
        }else{
            $dat=DB::table("participantes")->where("id",$value)->get();
            if(count($dat)==0){
                $arr=(array)$datos->datos->datos; 
                break;   
                $i++;
            }
        }
            
            
        }
        //var_dump($datos->datos);
        if(count($arr)>0){
            DB::table("participante")->where("id",$datos->datos->id)->update($arr);
        }
         
        return response()->json(["mensaje"=>"Gracias por registrarte ","respuesta"=>TRUE]);

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

    public function sincronizar(Request $request){
        //  var_dump($request->get("datos"));
        $participantes=$request->get("participantes");
        $detalle_participantes=$request->get("detalle_participantes");
        $procesos=$request->get("procesos");
        // echo "server => :(";
        //var_dump( $participantes);
        if($participantes!=false){
               foreach ($participantes as $key => $value) {



              //var_dump($value["pri_apellido"]);
              //var_dump($value["pri_nombre"]);
              //var_dump($value["seg_apellido"]);
              //var_dump($value["seg_nombre"]);
              //var_dump($value["ciud_nacimiento"]);
              //var_dump($value["tipo_registro"]);
              //var_dump($value["documento"]);
              //echo "=====</br>";
                 

              if($value["tipo_registro"]=="nuevo"){
                  $reg=DB::table("participantes")->where("documento",$value["documento"])->get();
                  //var_dump($reg);
                      if(count($reg)==0){

                          DB::table("participantes")
                           ->insert([
                                  "tipo_doc"=>$value["tipo_doc"],
                                  "documento"=>$value["documento"],
                                  "lugar_exp"=>$value["lugar_exp"],
                                  "pri_apellido"=>$value["pri_apellido"],
                                  "pri_nombre"=>$value["pri_nombre"],
                                  "seg_apellido"=>$value["seg_apellido"],
                                  "seg_nombre"=>$value["seg_nombre"],
                                  "ciud_nacimiento"=>$value["ciud_nacimiento"],
                                  "dep_nacimiento"=>$value["dep_nacimiento"],
                                  "fecha_nac"=>$value["fecha_nac"],
                                  "edad"=>$value["edad"],
                                  "genero"=>$value["genero"],
                                  "sub_genero"=>$value["sub_genero"],
                                  "cap_dife"=>$value["cap_dife"],
                                  "etnia"=>$value["etnia"],
                                  "sub_etnia"=>$value["sub_etnia"],
                                  "zona"=>$value["zona"],
                                  "departamento_ubi"=>$value["departamento_ubi"],
                                  "municipio"=>$value["municipio"],
                                  "celular"=>$value["celular"],
                                  "email"=>$value["email"],
                                  "escolaridad"=>$value["escolaridad"],
                                  "titulo_obt"=>$value["titulo_obt"],
                                  "huella_binaria"=>$value["huella_binaria"],
                                  "state"=>$value["state"],
                                  "estado_registro"=>$value["estado_registro"],
                                  "anio_ingreso_pdp"=>$value["anio_ingreso_pdp"],
                                  "cargo_poblador"=>$value["cargo_poblador"],
                                  "created_at"=>$value["created_at"],
                                  "updated_at"=>$value["updated_at"]                             

                                  ]);

                          
                      } 
                  
                     

              }else{
                      DB::table("participantes")
                        ->where("documento",$value["documento"])
                           ->update([
                                  "tipo_doc"=>$value["tipo_doc"],
                                  "documento"=>$value["documento"],
                                  "lugar_exp"=>$value["lugar_exp"],
                                  "pri_apellido"=>$value["pri_apellido"],
                                  "pri_nombre"=>$value["pri_nombre"],
                                  "seg_apellido"=>$value["seg_apellido"],
                                  "seg_nombre"=>$value["seg_nombre"],
                                  "ciud_nacimiento"=>$value["ciud_nacimiento"],
                                  "dep_nacimiento"=>$value["dep_nacimiento"],
                                  "fecha_nac"=>$value["fecha_nac"],
                                  "edad"=>$value["edad"],
                                  "genero"=>$value["genero"],
                                  "sub_genero"=>$value["sub_genero"],
                                  "cap_dife"=>$value["cap_dife"],
                                  "etnia"=>$value["etnia"],
                                  "sub_etnia"=>$value["sub_etnia"],
                                  "zona"=>$value["zona"],
                                  "departamento_ubi"=>$value["departamento_ubi"],
                                  "municipio"=>$value["municipio"],
                                  "celular"=>$value["celular"],
                                  "email"=>$value["email"],
                                  "escolaridad"=>$value["escolaridad"],
                                  "titulo_obt"=>$value["titulo_obt"],
                                  "huella_binaria"=>$value["huella_binaria"],
                                  "state"=>$value["state"],
                                  "estado_registro"=>$value["estado_registro"],
                                  "anio_ingreso_pdp"=>$value["anio_ingreso_pdp"],
                                  "cargo_poblador"=>$value["cargo_poblador"],
                                  "created_at"=>$value["created_at"],
                                  "updated_at"=>$value["updated_at"]           
                                 

                                  ]);    


                         
              }
              
          }

        }
        if($detalle_participantes!=false){
            foreach ($detalle_participantes as $key => $value) {

              //var_dump($value["user_id"]);

              //var_dump($value["pri_apellido"]);
              //var_dump($value["pri_nombre"]);
              //var_dump($value["seg_apellido"]);
              //var_dump($value["seg_nombre"]);
              //var_dump($value["ciud_nacimiento"]);
              //var_dump($value["dep_nacimiento"]);
              //var_dump($value["documento"]);
              //echo "=====</br>";
                 

             
                      $reg=DB::table("detalle_participantes")->where(
                        [[
                          "user_id",$value["user_id"]
                        ],
                        [
                          "event_id",$value["event_id"]
                        ]]
                      )->get();
                      //var_dump($reg);
                      if(count($reg)==0){
                          

                          DB::table("detalle_participantes")
                          ->insert(["user_id"=>$value["user_id"],"event_id"=>$value["event_id"],"created_at"=>$value["created_at"],"updated_at"=>$value["updated_at"]]);
                      }else{
                        DB::table("detalle_participantes")
                        ->where( [[
                          "user_id",$value["user_id"]
                        ],
                        [
                          "event_id",$value["event_id"]
                        ]])
                           ->update([
                                  
                                  "updated_at"=>$value["updated_at"]
                                 

                                  ]);    

                      }
                  
                     

              
                        
          }
         
        }


        if($procesos!=false){
          foreach ($procesos as $key => $value) {
                    $reg=DB::table("detalle_procesos")->where(
                        [[
                          "id_usuario",$value["id_usuario"]
                        ],
                        [
                          "id_proceso",$value["id_proceso"]
                        ]]
                      )->get();
                      //var_dump($reg);
                      if(count($reg)==0){
                          

                          DB::table("detalle_procesos")
                          ->insert(["id_usuario"=>$value["id_usuario"],"id_proceso"=>$value["id_proceso"],"created_at"=>$value["created_at"]]);
                      }
          }
        }      

      
          return response()->json(["mensaje"=>"Se han sincronizado los datos exitosamente","respuesta"=>TRUE]);     
        
        
        //var_dump($request->get("datos"));

    }


    public function  preparar(Request $request){
        
        $datos=$request->get("datos");
        //$c=json_decode($request->get("clave"));
        //var_dump($datos);
        //var_dump($datos["usuario"]);
        //var_dump($datos["clave"]);

       

        $us=DB::table("users")->where([["email",$datos["usuario"],["pass",$datos["clave"]]]])->get();

        $client = new Client();
        //consulto eventos patra este usuario
        $response = $client->request('POST', 'http://pdpmagdalenacentro.org/events',[
                'form_params' => [
                    'token' => 'iylC+Y1IKoEbdsAsUXIF+CU+fyn/hEnQg0hMfM0UWnTa05lrOOJExVJEYkyGoRfpYeu0vn/BxI5vcKdgkqZU7A==',
                    'id'=>$datos["id"],
                    'email_user'=>$datos["usuario"], 
                    'pass_user'=>$datos["clave"]
                    
                ]
            ]);
       
   
       $d=json_decode($response->getBody()->getContents());
       //var_dump($d);    
       $arr=[];
       $current = Carbon::now(new DateTimeZone("America/Bogota"));
       $hoy= $current->toDateTimeString();
      
       foreach ($d as $key => $value) {
            
            $dat=DB::table("eventos")->where("id",$value->id_event)->get();
            
            if(count($dat)==0){
                if($value->state==="true"){
                     //var_dump($value->state);
                    $arr[$key]=(array)$value; 
                    //var_dump($arr[$key]);
                    $arr[$key]["id"]=$arr[$key]["id_event"];
                    unset($arr[$key]["id_event"]);
                    $arr[$key]["state"]=(Boolean)$arr[$key]["state"];
                    $arr[$key]["created_at"]=$hoy;
                    $arr[$key]["updated_at"]=$hoy;
                   
                    DB::table("eventos")->insert($arr[$key]);   
                   
                    
                }
            }else{
                //echo "existe";
                 //var_dump($value->id_event); 
                 $arr[$key]=(array)$value; 
                 
                 $arr[$key]["created_at"]=$hoy;
                 $arr[$key]["updated_at"]=$hoy;
                 $arr[$key]["id"]=$arr[$key]["id_event"];
                 unset($arr[$key]["id_event"]);
                 //var_dump($arr[$key]["id"]);
                 DB::table("eventos")->where("id",$arr[$key]["id"])
                                     ->update(["name"=>$arr[$key]["name"],
                                              "description"=>$arr[$key]["description"],
                                              "date"=>$arr[$key]["date"],
                                              "city"=>$arr[$key]["city"],
                                              "address"=>$arr[$key]["address"],
                                              "atachments"=>$arr[$key]["atachments"],
                                              "state"=>(Boolean)$arr[$key]["state"],
                                              "img"=>"",
                                              "updated_at"=>$hoy
                                                ]);  
                
                
            }
            
        }





         //var_dump($arr);

        $par=DB::table("participantes")->where("state",1)->get();
        $arr_p=array();
         
        foreach ($par as $key => $value) {
          
            $arr_p[$key]=(array)$value;
            
            $arr_p[$key]["huella_binaria"]=convert_uuencode ($value->huella_binaria);
        }
      
      
        $lineas=DB::table("lineas")->get();
        $procesos=DB::table("proceso")->get();
        $detalle_procesos=DB::table("detalle_procesos")->get();
        //var_dump($detalle_procesos);
        if(count($arr) == false){
          return response()->json(array("respuesta"=>FALSE,"mensaje"=>"No hay eventos para sincronizar"));
        }else{
          return response()->json(array("detalle_procesos"=>$detalle_procesos,"eventos"=>$arr,"respuesta"=>TRUE,"mensaje"=>"datos enviados","usuario"=>$us[0],"participantes"=>$arr_p,"lineas"=>$lineas,"procesos"=>$procesos));
        }


       }
    
}
