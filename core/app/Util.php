<?php

namespace App;

use Mail;

use DB;

use DateTime;

class Util 
{
    /*
      funcion para decodificar una peticion HTTP POST,PUT
      {$datos_string = datos de la peticion}
    */
    public static function decodificar_json($datos_string){
    	$datos=json_decode($datos_string);
    	//var_dump(json_decode($datos_string));
        //$form=json_decode($datos->datos);
        //echo "--";
        //var_dump($datos);
        
        return ["hora_cliente"=>$datos->hora_cliente,"peticion"=>$datos->peticion,"datos"=>$datos->datos];
    }
    
    
    /*
        {ruta}=>tuta de la vista para el email
    	{array_datos}=> array de datos a enviar ['user' => $user]
        {de}=>correo que envia
        {de_nombre}=> nombre de quien envia
        {asunto} => asunto de correo
        {destino} => destino del correo
        {$nombre_destino} => nombre del destinatario
    */
    public static function enviar_email($ruta,$array_datos,$de,$de_nombre,$asunto,$destino,$nombre_destino){

    	  Mail::send($ruta,$array_datos , function ($m) use ($destino,$nombre_destino,$de,$de_nombre,$asunto) {
		            $m->from($de, $de_nombre);

		            $m->to($destino, $nombre_destino)->subject($asunto);
		        });
          
    }
    
    //función que escribe la IP del cliente en un archivo de texto    
    public static function write_visita (){

        //Indicar ruta de archivo válida
        $archivo=trim(substr(base_path(),0,-4)."visitas")."/visitas.txt";

        //Si que quiere ignorar la propia IP escribirla aquí, esto se podría automatizar
        $ip="mi.ip.";
        $new_ip=Util::get_client_ip();

        if ($new_ip!==$ip){
            $now = new DateTime();

       //Distinguir el tipo de petición, 
       // tiene importancia en mi contexto pero no es obligatorio
            
        if (!$_GET) {
            $datos=$_POST;

        } 
        else
        {
            //Saber a qué URL se accede
            $peticion = explode('/', $_GET['PATH_INFO']);
            $datos=str_pad($peticion[0],10).' '.$peticion[1];   
        }

        $txt =  str_pad($new_ip,25). " ".
                str_pad($now->format('Y-m-d H:i:s'),25)." ".
                str_pad(Util::ip_info($new_ip, "Country"),25)." ".json_encode($datos);

        $myfile = file_put_contents($archivo, $txt.PHP_EOL , FILE_APPEND);


        }
    }


    //Obtiene la IP del cliente
    public static function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }


    //Obtiene la info de la IP del cliente desde geoplugin

    public static function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }
	

    public static function validar_token_login($usuario,$clave){
        
        if( isset( $_POST["datos"] ) ){

            $dt=json_decode($_POST["datos"]);
        }else if( isset( $_GET["datos"] ) ){

            $dt=json_decode($_GET["datos"]);
        }
        //var_dump($dt->token);

        $aprovado=DB::table("usuarios")
                ->where([["correo_usuario","=",$usuario],
                        ["password","=",$clave]])
                //->orwhere("correo_usuario",$usuario)
                ->get();
        if(count($aprovado)>0){
            if($aprovado[0]->remember_token!=" " && $aprovado[0]->remember_token!=$dt->token ){

                //if($dt->token != "0" && count($aprovado)==0){
                    return ["datos"=>$aprovado[0],"respuesta"=>TRUE];
                //}      
        
            }
        }
        
        
          

        

    }

     public static function validar_token(){
        
        if( isset( $_POST["datos"] ) ){

            $dt=json_decode($_POST["datos"]);
        }else if( isset( $_GET["datos"] ) ){

            $dt=json_decode($_GET["datos"]);
        }
      

        $aprovado=DB::table("usuarios")
                ->where("remember_token",$dt->token)
                //->orwhere("correo_usuario",$usuario)
                ->get();
         //var_dump($aprovado);       
        if(count($aprovado)==0){

            //if($aprovado[0]->remember_token!=" " && $aprovado[0]->remember_token!=$dt->token ){

                //if($dt->token != "0" && count($aprovado)==0){
                    return TRUE;
                //}      
        
            //}
        }
        
        
          

        

    }
   
    public static function enviar_msn_server_event(){
        $re=DB::table("participantes")
                ->where("estado_registro","=","por_registrar")
                ->select("id")
                ->get();    
                //var_dump($re);
                //echo count($re);
                //echo "<br>";
        if(count($re) > 0){

            return array("datos"=>$re,"respuesta"=>false);
       }else{
            Util::enviar_msn_server_event();
       }



    }
    
      public static function enviar_msn_server_event_2(){
        echo "id: $id" . PHP_EOL;
                echo "data: {\n";
               
                echo "data: \"id\": $id\n";
                echo "data: }\n";
                echo PHP_EOL;
               


    }

}
