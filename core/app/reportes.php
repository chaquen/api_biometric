<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class reportes extends Model
{
    //

    public function reporte_lista($datos){


        $ssql="";
        $sql_base_tbl_eventos_G=trim("SELECT eventos.name,eventos.date,COUNT(eventos.id) as cuantos_por_eventos,city FROM `detalle_participantes` INNER join eventos on eventos.id=detalle_participantes.event_id ");
        $sql_base_tbl_eventos=trim("SELECT eventos.name,eventos.date,COUNT(eventos.id) as cuantos_por_eventos,city FROM `detalle_participantes` INNER join eventos on eventos.id=detalle_participantes.event_id WHERE ");

        $sql_base=trim("
                    SELECT participantes.id,participantes.tipo_doc,participantes.documento,participantes.pri_nombre,participantes.seg_nombre,participantes.pri_apellido,participantes.seg_apellido  ,participantes.edad,participantes.genero,participantes.escolaridad,participantes.zona,participantes.dep_nacimiento,participantes.ciud_nacimiento,participantes.municipio,participantes.etnia,participantes.cap_dife,participantes.departamento_ubi,participantes.edad,participantes.anio_ingreso_pdp,participantes.celular,detalle_participantes.acepta_terminos,detalle_participantes.acepta_terminos_foto FROM participantes 
                        INNER JOIN detalle_participantes ON detalle_participantes.user_id = participantes.documento 
                        INNER JOIN detalle_procesos ON detalle_procesos.id_usuario = participantes.documento
                        INNER JOIN proceso ON proceso.id = detalle_procesos.id_proceso
                        INNER JOIN lineas ON lineas.id = proceso.fk_id_linea
                        INNER JOIN eventos ON detalle_participantes.event_id = eventos.id

                     WHERE ");
        $sql_base_id=trim("
                    SELECT participantes.id FROM participantes 
                        INNER JOIN detalle_participantes ON detalle_participantes.user_id = participantes.documento 
                        INNER JOIN detalle_procesos ON detalle_procesos.id_usuario = participantes.documento
                        INNER JOIN proceso ON proceso.id = detalle_procesos.id_proceso
                        INNER JOIN lineas ON lineas.id = proceso.fk_id_linea
                        INNER JOIN eventos ON detalle_participantes.event_id = eventos.id
                     WHERE ");
        $sql_base_genero=trim("
                    SELECT participantes.genero,COUNT(genero) AS cuentos_por_genero FROM participantes WHERE participantes.id IN (");
        $sql_base_sub_genero=trim("
                    SELECT participantes.sub_genero,COUNT(sub_genero) AS cuentos_por_sub_genero FROM participantes WHERE participantes.id IN (");
        $sql_base_edad=trim("
                    SELECT participantes.edad,COUNT(edad) AS cuentos_por_edad FROM participantes WHERE participantes.id IN (");
        $sql_base_dep_nacimiento=trim("
                    SELECT participantes.dep_nacimiento,COUNT(dep_nacimiento) AS cuantos_por_dep_nacimiento FROM participantes WHERE participantes.id IN (");
        $sql_base_ciud_nacimiento=trim("
                    SELECT participantes.ciud_nacimiento,COUNT(ciud_nacimiento) AS cuantos_por_ciud_nacimiento FROM participantes WHERE participantes.id IN (");
        $sql_base_vereda_nacimiento=trim("
                    SELECT participantes.vereda_nacimiento,COUNT(vereda_nacimiento) AS cuantos_por_vereda_nacimiento FROM participantes WHERE participantes.id IN (");

        $sql_base_dep_ubi=trim("
                    SELECT participantes.departamento_ubi,COUNT(departamento_ubi) AS cuantos_por_departamento_ubi FROM participantes WHERE participantes.id IN (");
        $sql_base_ciud_ubi=trim("
                    SELECT participantes.municipio,COUNT(municipio) AS cuantos_por_ciud_ubi FROM participantes WHERE participantes.id IN (");
        $sql_base_vereda_ubi=trim("
                    SELECT participantes.vereda_ubi,COUNT(vereda_ubi) AS cuantos_por_vereda_ubi FROM participantes WHERE participantes.id IN (");        
        $sql_base_cap_dife=trim("
                    SELECT participantes.cap_dife,COUNT(cap_dife) AS cuantos_por_cap_dife FROM participantes WHERE participantes.id IN (");
        $sql_base_etnia=trim("
                    SELECT participantes.etnia,COUNT(etnia) AS cuantos_por_etnia FROM participantes WHERE participantes.id IN ( ");
         $sql_base_sub_etnia=trim("
                    SELECT participantes.sub_etnia,COUNT(sub_etnia) AS cuantos_por_etnia FROM participantes WHERE participantes.id IN (");

        $sql_base_escolaridad=trim("
                    SELECT participantes.escolaridad,COUNT(escolaridad) AS cuantos_por_escolaridad FROM participantes WHERE participantes.id IN (");
        $sql_base_titulo=trim("
                    SELECT participantes.titulo_obt,COUNT(titulo_obt) AS cuantos_por_titulo FROM participantes WHERE participantes.id IN (");
        $sql_base_cargo=trim("
                    SELECT participantes.cargo_poblador,COUNT(cargo_poblador) AS cuantos_por_cargo FROM participantes WHERE participantes.id IN (");
        $sql_base_ingreso_pdp=trim("
                    SELECT participantes.anio_ingreso_pdp,COUNT(anio_ingreso_pdp) AS cuantos_por_anio FROM participantes WHERE participantes.id IN (");
         $sql_base_zona=trim("
                    SELECT participantes.zona,COUNT(zona) AS cuantos_por_zona FROM participantes WHERE participantes.id IN (");
        $sql_base_linea_organizacion=trim("
                    SELECT lineas.nombre_linea as organizacion,COUNT(lineas.id) AS cuantos_por_organizacion FROM participantes 
                    INNER JOIN detalle_procesos ON participantes.documento = detalle_procesos.id_usuario 
                    INNER join proceso ON proceso.id = detalle_procesos.id_proceso
                    INNER JOIN lineas ON lineas.id = proceso.fk_id_linea
                    WHERE participantes.id IN (");
        $sql_base_proceso=trim("
                    SELECT proceso.nombre_proceso as proceso,COUNT(proceso.id) AS cuantos_por_proceso FROM participantes 
                    INNER JOIN detalle_procesos ON participantes.documento = detalle_procesos.id_usuario 
                    INNER join proceso ON proceso.id = detalle_procesos.id_proceso
                    INNER JOIN lineas ON lineas.id = proceso.fk_id_linea
                    WHERE participantes.id IN (");
                    
        $sql_base_doc=trim("
                    SELECT eventos.name,participantes.id,participantes.id,participantes.tipo_doc,participantes.documento,participantes.pri_nombre,participantes.seg_nombre,participantes.pri_apellido,participantes.seg_apellido,participantes.edad,participantes.genero,participantes.escolaridad,participantes.zona,participantes.dep_nacimiento,participantes.ciud_nacimiento,participantes.municipio,detalle_participantes.updated_at,participantes.cap_dife,participantes.etnia,participantes.departamento_ubi,participantes.edad,participantes.anio_ingreso_pdp,participantes.celular,,detalle_participantes.acepta_terminos,detalle_participantes.acepta_terminos_foto FROM participantes 
                        INNER JOIN detalle_participantes ON detalle_participantes.user_id = participantes.documento 
                        INNER JOIN detalle_procesos ON detalle_procesos.id_usuario = participantes.documento
                        INNER JOIN proceso ON proceso.id = detalle_procesos.id_proceso
                        INNER JOIN lineas ON lineas.id = proceso.fk_id_linea
                        INNER JOIN eventos ON detalle_participantes.event_id = eventos.id
                     WHERE ");
         $sql_base_nom=trim("
                    SELECT eventos.id,eventos.name,participantes.id,participantes.id,participantes.tipo_doc,participantes.documento,participantes.pri_nombre,participantes.seg_nombre,participantes.pri_apellido,participantes.seg_apellido,participantes.edad,participantes.genero,participantes.escolaridad,participantes.zona,participantes.dep_nacimiento,participantes.ciud_nacimiento,participantes.municipio,detalle_participantes.updated_at,participantes.cap_dife,participantes.etnia,participantes.departamento_ubi,participantes.edad,participantes.anio_ingreso_pdp,participantes.celular,detalle_participantes.acepta_terminos,detalle_participantes.acepta_terminos_foto FROM participantes 
                        INNER JOIN detalle_participantes ON detalle_participantes.user_id = participantes.documento 
                        INNER JOIN detalle_procesos ON detalle_procesos.id_usuario = participantes.documento
                        INNER JOIN proceso ON proceso.id = detalle_procesos.id_proceso
                        INNER JOIN lineas ON lineas.id = proceso.fk_id_linea
                        INNER JOIN eventos ON detalle_participantes.event_id = eventos.id
                     WHERE ");
        $sql_base_acepta_terminos=trim("
                     SELECT detalle_participantes.acepta_terminos,COUNT(detalle_participantes.user_id) AS cuantos_por_proceso_acepta FROM detalle_participantes WHERE detalle_participantes.user_id IN (");
         $dadoc=array();
         $danom=array();
         $sqlnom=" ";
         $sqldoc=" ";
        //COUNSTRUIR SENTENCIA
        switch ($datos->datos->id_evento) {
             case 'G':
                    $sql=" ";
                    foreach ($datos->datos->datos as $key => $value) {
                            if(gettype($value)=="array"){

                                switch ($key) {
                                    case 'tipo_doc':

                                            $sql.=" tipo_doc IN (";

                                            foreach ($value as $k => $v) {
                                                if($k==count($value)-1){
                                                    $sql.="'".$v."') AND";
                                                    break;
                                                }
                                                $sql.="'".$v."',";
                                                
                                            }
                                           
                                        break;
                                    case 'edad':
                                         $sql.="(";
                                            foreach ($value as $k => $v) {
                                                if($k==count($value)-1){
                                                    $sql.=" edad  >= '".explode("a", $v)[0]."' AND edad <= '".explode("a", $v)[1]."') AND ";
                                                    break;
                                                }
                                                $sql.=" edad >= '".explode("a", $v)[0]."' AND  edad <= '".explode("a", $v)[1]."' OR ";
                                                
                                            }

                                        break; 
                                    case 'zonas':
                                     $sql.=" zona IN (";
                                            foreach ($value as $k => $v) {
                                                if($k==count($value)-1){
                                                    $sql.="'".$v."') AND";
                                                    break;
                                                }
                                                $sql.="'".$v."',";
                                                
                                            }
                                        # code...
                                        break; 
                                    case 'genero':
                                         $sql.=" genero IN (";
                                            foreach ($value as $k => $v) {
                                                if($k==count($value)-1){
                                                    $sql.="'".$v."') AND";
                                                    break;
                                                }
                                                $sql.="'".$v."',";
                                                
                                            }
                                        break;  
                                    case 'escolaridad':
                                        $sql.=" escolaridad IN (";
                                            foreach ($value as $k => $v) {
                                                if($k==count($value)-1){
                                                    $sql.="'".$v."') AND";
                                                    break;
                                                }
                                                $sql.="'".$v."',";
                                                
                                            }
                                        break;            
                                    case 'etnia':
                                        $sql.=" etnia IN (";
                                            foreach ($value as $k => $v) {
                                                if($k==count($value)-1){
                                                    $sql.="'".$v."') AND";
                                                    break;
                                                }
                                                $sql.="'".$v."',";
                                                
                                            }
                                        break;
                                    case 'acepta_terminos':
                                     $sql.=" acepta_terminos IN (";
                                            foreach ($value as $k => $v) {
                                                if($k==count($value)-1){
                                                    $sql.="'".$v."') AND";
                                                    break;
                                                }
                                                $sql.="'".$v."',";
                                                
                                            }
                                        # code...
                                        break;     
                                    default:
                                        # code...
                                        break;
                                }
                            }
                    }
                    $sql_org=" ";
                    $sql_pro=" ";
                    foreach ($datos->datos->datos as $key => $value) {
                            if(gettype($value)!="array" && $value != "" && $key!="tipo_reporte"){
                                if($key=="dep_nacimiento"){
                                    $value=explode("-", $value)[1];
                                }
                                if($key=="documento"){
                                    $sql.=" documento = '".$value."' AND";
                                    $sqlnom.=" documento = '".$value."'";
                                    //echo $sql_base_doc;
                                    
                                }
                                if($key=="pri_nombre"){
                                    $sql.=" pri_nombre LIKE '".$value."' OR seg_nombre LIKE '".$value."' OR pri_apellido LIKE '".$value."' OR seg_apellido = '".$value."' AND";

                                   $sqldoc.=" pri_nombre LIKE '".$value."' OR seg_nombre LIKE '".$value."' OR pri_apellido LIKE '".$value."' OR seg_apellido = '".$value."'";
                                }
                                if($key=="lineas.nombre_linea" && $value!=""){
                                    $sql_org.=" AND lineas.id = '".explode("-", $value)[0]."'";
                                     $sql.=" lineas.id = '".explode("-", $value)[0]."' AND";  
                                }
                                if($key == "proceso.nombre_proceso" && $value!=""){
                                    $sql_pro.=" AND proceso.id = '".explode("-", $value)[0]."'";
                                     $sql.=" proceso.id = '".explode("-", $value)[0]."' AND";  
                                }
                                if($key!="documento" && $key != "id_evento" && $key != "pri_nombre" && $key != "lineas.nombre_linea" && $key != "proceso.nombre_proceso"){
                                    $sql.=" $key ='".$value."' AND";    
                                }
                            }
                    }
                 break;
             
             default:
                
                    $sql=" ";
                   
                    if(gettype($datos->datos->id_evento)=="array"){
                        $sql.=" eventos.id IN ( ";
                        $fin =count($datos->datos->id_evento)-1; 
                        foreach ($datos->datos->id_evento as $key => $value) {
                            if($key==$fin){
                                $sql.=" '".$value."') ";
                                break;
                            }else{
                                $sql.=" '".$value."', ";
                            }
                           
                        }
                        $sql.= " AND ( ";
                    }else{
                        $sql.= " eventos.id = '".$datos->datos->id_evento."' AND ( ";    
                    }

                    foreach ($datos->datos->datos as $key => $value) {
                            if(gettype($value)=="array"){
                                switch ($key) {
                                    case 'tipo_doc':

                                            $sql.=" tipo_doc IN (";
                                            foreach ($value as $k => $v) {
                                                if($k==count($value)-1){
                                                    $sql.="'".$v."') AND";
                                                    break;
                                                }
                                                $sql.="'".$v."',";
                                                
                                            }
                                            
                                        break;
                                    case 'edad':
                                         $sql.="(";
                                            foreach ($value as $k => $v) {
                                                if($k==count($value)-1){
                                                    $sql.=" edad  >= '".explode("a", $v)[0]."' AND edad <= '".explode("a", $v)[1]."')AND ";
                                                    break;
                                                }
                                                $sql.=" edad >= '".explode("a", $v)[0]."' AND  edad <= '".explode("a", $v)[1]."' OR ";
                                                
                                            }

                                        break; 
                                    case 'zonas':
                                     $sql.=" zona IN (";
                                            foreach ($value as $k => $v) {
                                                if($k==count($value)-1){
                                                    $sql.="'".$v."') AND";
                                                    break;
                                                }
                                                $sql.="'".$v."',";
                                                
                                            }
                                        # code...
                                        break; 
                                    case 'genero':
                                         $sql.=" genero IN (";
                                            foreach ($value as $k => $v) {
                                                if($k==count($value)-1){
                                                    $sql.="'".$v."') AND";
                                                    break;
                                                }
                                                $sql.="'".$v."',";
                                                
                                            }
                                        break;  
                                    case 'escolaridad':
                                        $sql.=" escolaridad IN (";
                                            foreach ($value as $k => $v) {
                                                if($k==count($value)-1){
                                                    $sql.="'".$v."') AND";
                                                    break;
                                                }
                                                $sql.="'".$v."',";
                                                
                                            }
                                        break;   
                                    case 'etnia':
                                        $sql.=" etnia IN (";
                                            foreach ($value as $k => $v) {
                                                if($k==count($value)-1){
                                                    $sql.="'".$v."') AND";
                                                    break;
                                                }
                                                $sql.="'".$v."',";
                                                
                                            }
                                        break;             
                                    case 'acepta_terminos':
                                     $sql.=" acepta_terminos IN (";
                                            foreach ($value as $k => $v) {
                                                if($k==count($value)-1){
                                                    $sql.="'".$v."') AND";
                                                    break;
                                                }
                                                $sql.="'".$v."',";
                                                
                                            }
                                        # code...
                                        break; 
                                    default:
                                        # code...
                                        break;
                                }
                            }
                    }
                    //echo $sql_base_nom;
                    //echo ":(";
                    //echo $sql_base_nom;
                    $sql_org=" ";
                    $sql_pro=" ";
                    foreach ($datos->datos->datos as $key => $value) {
                            if(gettype($value)!="array" && $value != "" && $key!="tipo_reporte" ){
                                if($key=="dep_nacimiento"){
                                    $value=explode("-", $value)[1];
                                }
                                //echo $key."<br>";
                                if($key=="documento"){
                                    $sql.=" documento = '".$value."' AND ";
                                    $fin =count($datos->datos->id_evento)-1; 
                                    $sql_eve_doc=" AND eventos.id IN (";
                                    $sqldoc.=" documento = '".$value."' ";
                                   
                                    foreach($datos->datos->id_evento as $value){
                                        if($fin==$key){
                                            $sql_eve_doc.="'".$value."')";   
                                            break;  
                                        }
                                        $sql_eve_doc.="'".$value."',";     
                                    }
                                    
                                    $sqldoc.=$sql_eve_doc;
                                    
                                    
                                }
                                if($key=="pri_nombre"){
                                    $sql.=" pri_nombre LIKE '".$value."' OR seg_nombre LIKE '".$value."' OR pri_apellido LIKE '".$value."' OR seg_apellido = '".$value."' AND " ;
                                    $fin =count($datos->datos->id_evento)-1; 
                                    $sql_eve_nom=" AND eventos.id IN (";
                                    $sqlnom.="(pri_nombre LIKE '".$value."' OR seg_nombre LIKE '".$value."' OR pri_apellido LIKE '".$value."' OR seg_apellido = '".$value."'".") ";    
                                    foreach($datos->datos->id_evento as $value){
                                        if($fin==$key){
                                            $sql_eve_nom.="'".$value."')";     
                                            break;
                                        }
                                        $sql_eve_nom.="'".$value."',";     
                                    }
                                    
                                    $sqlnom.=$sql_eve_nom;
                                    
                                //echo $sql_base_nom.$sql_2 ;   
                                    
                                }
                                if($key=="lineas.nombre_linea" && $value!=""){
                                    $sql_org.=" AND lineas.id = '".explode("-", $value)[0]."'";
                                     $sql.=" lineas.id = '".explode("-", $value)[0]."' AND ";  
                                }
                                if($key == "proceso.nombre_proceso" && $value!=""){
                                    $sql_pro.=" AND proceso.id = '".explode("-", $value)[0]."'";
                                     $sql.=" proceso.id = '".explode("-", $value)[0]."' AND ";  
                                }
                                if($key!="documento" && $key != "id_evento" && $key != "pri_nombre" && $key != "lineas.nombre_linea" && $key!="proceso.nombre_proceso"){
                                    $sql.=" $key ='".$value."' AND ";    
                                }
                            }
                    }
                    
                    //echo ":=(";
                    //echo $sql;
                 break;
        }
      
        //echo $sql_base_genero.$sql_base.$sql.") GROUP BY genero";
        //var_dump($sqldoc);                
        $i=0;


        if($datos->datos->id_evento=="G"){
            $sql=substr($sql,0,-4);
            //echo "::".$sql_base.$sql." GROUP BY id";
            $res=DB::select(trim($sql_base.$sql." GROUP BY id"));
        }else{
            $sql=substr($sql,0,-4);    
            //echo $sql_base.$sql.") GROUP BY id";
            $res=DB::select(trim($sql_base.$sql.") GROUP BY id"));
        }

      
        //EJECUTAR SENTENCIA
        switch ($datos->datos->id_evento) {
            case 'G':
                    if($sql!="" && $sql!=" " ){
                        $dagen=DB::select(trim($sql_base_genero.$sql_base_id.$sql.") GROUP BY genero")); 
                        $dasubgen=DB::select(trim($sql_base_sub_genero.$sql_base_id.$sql." AND sub_genero <> 'NULL' )  GROUP BY sub_genero"));                       
                        $daedad=DB::select(trim($sql_base_edad.$sql_base_id.$sql.") GROUP BY edad")); 
                        $dadepnac=DB::select(trim($sql_base_dep_nacimiento.$sql_base_id.$sql.") GROUP BY dep_nacimiento"));  
                        $daciunac=DB::select(trim($sql_base_ciud_nacimiento.$sql_base_id.$sql.") GROUP BY ciud_nacimiento")); 
                        $davernac=DB::select(trim($sql_base_vereda_nacimiento.$sql_base_id.$sql." AND vereda_nacimiento <> 'NULL' ) GROUP BY vereda_nacimiento")); 
                        $dadepubi=DB::select(trim($sql_base_dep_ubi.$sql_base_id.$sql.") GROUP BY departamento_ubi"));  
                        $daciuubi=DB::select(trim($sql_base_ciud_ubi.$sql_base_id.$sql.") GROUP BY municipio")); 
                        $daverubi=DB::select(trim($sql_base_vereda_ubi.$sql_base_id.$sql." AND vereda_ubi <> 'NULL' ) GROUP BY vereda_ubi")); 
                        $dacapdif=DB::select(trim($sql_base_cap_dife.$sql_base_id.$sql.") GROUP BY cap_dife"));   
                        $daetnia=DB::select(trim($sql_base_etnia.$sql_base_id.$sql.") GROUP BY etnia"));
                        $dasubetnia=DB::select(trim($sql_base_sub_etnia.$sql_base_id.$sql." AND sub_etnia <> 'NULL' ) GROUP BY sub_etnia"));
                        $daescolaridad=DB::select(trim($sql_base_escolaridad.$sql_base_id.$sql.") GROUP BY escolaridad"));
                        $datitulo=DB::select(trim($sql_base_titulo.$sql_base_id.$sql.") GROUP BY titulo_obt"));
                        $daanioingreso=DB::select(trim($sql_base_ingreso_pdp.$sql_base_id.$sql.") GROUP BY anio_ingreso_pdp"));

                        $dacargo=DB::select(trim($sql_base_cargo.$sql_base_id.$sql.") GROUP BY cargo_poblador"));
                        $dazona=DB::select(trim($sql_base_zona.$sql_base_id.$sql.") GROUP BY zona"));
                        

                        if($sql_org!=" "){

                            $daorga=DB::select(trim($sql_base_linea_organizacion.$sql_base_id.$sql." )".$sql_org." GROUP BY lineas.id"));    
                        }else{
                            $daorga=DB::select(trim($sql_base_linea_organizacion.$sql_base_id.$sql." ) GROUP BY lineas.id"));
                        }
                        
                        if($sql_org==" " && $sql_pro == " "){
                            $daproc=DB::select(trim($sql_base_proceso.$sql_base_id.$sql." ) GROUP BY proceso.id"));
                        }
                        if($sql_org!=" " && $sql_pro == " "){
                            $daproc=DB::select(trim($sql_base_proceso.$sql_base_id.$sql." ".$sql_org." )  ".$sql_org." GROUP BY proceso.id"));
                        }
                        //var_dump($sql_pro);
                        //var_dump($sql_org);

                        if($sql_org==" " && $sql_pro != " "){
                            //ECHO trim($sql_base_proceso.$sql_base_id.$sql." )  ".$sql_pro." GROUP BY proceso.id");
                            $daproc=DB::select(trim($sql_base_proceso.$sql_base_id.$sql." )  ".$sql_pro." GROUP BY lineas.id"));
                        }

                        if($sql_org!=" " && $sql_pro != " "){
                            $daproc=DB::select(trim($sql_base_proceso.$sql_base_id.$sql." )  ".$sql_org." GROUP BY proceso.id"));
                        }


                        $daterminos=DB::select(trim($sql_base_acepta_terminos.$sql_base_id.$sql.") GROUP BY acepta_terminos")); 
                            



                        
                         
                        $datbleventos=DB::select(trim($sql_base_tbl_eventos_G." GROUP BY eventos.id ORDER BY cuantos_por_eventos DESC"));
                    }
                    if($sqldoc!="" && $sqldoc!=" "){
                        $dadoc=DB::select(trim($sql_base_doc.$sqldoc." GROUP BY documento,eventos.id"));  
                    }

                    if($sqlnom!="" && $sqlnom!=" "){
                        
                        $danom=DB::select(trim($sql_base_nom.$sqlnom."  GROUP BY eventos.id,participantes.id ORDER BY eventos.id"));    
                    }


                    $ssql=trim(trim($sql_base_acepta_terminos.$sql_base_id.$sql.") GROUP BY acepta_terminos"));
                    
                       
                break;
            
            default:
                if($sql!="" && $sql!=" " ){
                        $dagen=DB::select(trim($sql_base_genero.$sql_base_id.$sql.")) GROUP BY genero")); 
                        $dasubgen=DB::select(trim($sql_base_sub_genero.$sql_base_id.$sql.") AND sub_genero <> 'NULL' ) GROUP BY sub_genero"));                      
                        $daedad=DB::select(trim($sql_base_edad.$sql_base_id.$sql.")) GROUP BY edad")); 
                        $dadepnac=DB::select(trim($sql_base_dep_nacimiento.$sql_base_id.$sql.")) GROUP BY dep_nacimiento"));  
                        $daciunac=DB::select(trim($sql_base_ciud_nacimiento.$sql_base_id.$sql.")) GROUP BY ciud_nacimiento"));
                        $davernac=DB::select(trim($sql_base_vereda_nacimiento.$sql_base_id.$sql.") AND vereda_nacimiento <> 'NULL') GROUP BY vereda_nacimiento"));  
                        $dadepubi=DB::select(trim($sql_base_dep_ubi.$sql_base_id.$sql.")) GROUP BY departamento_ubi"));  
                        $daciuubi=DB::select(trim($sql_base_ciud_ubi.$sql_base_id.$sql.")) GROUP BY municipio"));
                        $daverubi=DB::select(trim($sql_base_vereda_ubi.$sql_base_id.$sql.") AND vereda_ubi <> 'NULL') GROUP BY vereda_ubi"));  
                        $dacapdif=DB::select(trim($sql_base_cap_dife.$sql_base_id.$sql.")) GROUP BY cap_dife"));   
                        $daetnia=DB::select(trim($sql_base_etnia.$sql_base_id.$sql.")) GROUP BY etnia"));
                        $dasubetnia=DB::select(trim($sql_base_sub_etnia.$sql_base_id.$sql.") AND sub_etnia <> 'NULL' ) GROUP BY sub_etnia"));
                        $daescolaridad=DB::select(trim($sql_base_escolaridad.$sql_base_id.$sql.")) GROUP BY escolaridad"));
                        $datitulo=DB::select(trim($sql_base_titulo.$sql_base_id.$sql.")) GROUP BY titulo_obt"));
                        $daanioingreso=DB::select(trim($sql_base_ingreso_pdp.$sql_base_id.$sql.")) GROUP BY anio_ingreso_pdp"));
                        $dacargo=DB::select(trim($sql_base_cargo.$sql_base_id.$sql.")) GROUP BY cargo_poblador")); 
                        $dazona=DB::select(trim($sql_base_zona.$sql_base_id.$sql.")) GROUP BY zona"));
                        //$daorga=DB::select(trim($sql_base_linea_organizacion.$sql_base_id.$sql.")) ".$sql_org." GROUP BY lineas.id"));
                        //$daproc=DB::select(trim($sql_base_proceso.$sql_base_id.$sql.")) ".$sql_pro." GROUP BY proceso.id")); 



                        if($sql_org!=" "){

                            $daorga=DB::select(trim($sql_base_linea_organizacion.$sql_base_id.$sql." ".$sql_org." ))".$sql_org." GROUP BY lineas.id"));    
                        }else{
                            $daorga=DB::select(trim($sql_base_linea_organizacion.$sql_base_id.$sql." )) GROUP BY lineas.id"));
                        }
                        
                        if($sql_org==" " && $sql_pro == " "){
                            $daproc=DB::select(trim($sql_base_proceso.$sql_base_id.$sql." )) GROUP BY proceso.id"));
                        }
                        if($sql_org!=" " && $sql_pro == " "){
                            $daproc=DB::select(trim($sql_base_proceso.$sql_base_id.$sql." ".$sql_org." ))  ".$sql_org." GROUP BY proceso.id"));
                        }
                        //var_dump($sql_pro);
                        //var_dump($sql_org);

                        if($sql_org==" " && $sql_pro != " "){
                            //$ssql= trim($sql_base_proceso.$sql_base_id.$sql." ))  ".$sql_pro." GROUP BY proceso.id");
                            $daproc=DB::select(trim($sql_base_proceso.$sql_base_id.$sql." ))  ".$sql_pro." GROUP BY proceso.id"));
                        }

                        if($sql_org!=" " && $sql_pro != " "){
                            $daproc=DB::select(trim($sql_base_proceso.$sql_base_id.$sql." ))  ".$sql_org." GROUP BY proceso.id"));
                        }






                       


                        if(gettype($datos->datos->id_evento)=="array"){
                            
                            $sql_eve=" eventos.id IN ( ";
                            $fin =count($datos->datos->id_evento)-1; 
                            foreach ($datos->datos->id_evento as $key => $value) {
                                if($key==$fin){
                                    $sql_eve.= " '".$value."') ";
                                    break;
                                }else{
                                    $sql_eve.=" '".$value."', ";
                                }
                            }
                           

                           

                             $datbleventos=DB::select(trim($sql_base_tbl_eventos.$sql_eve." GROUP BY eventos.id"));
                        }else{
                             $datbleventos=DB::select(trim($sql_base_tbl_eventos." eventos.id = '".$datos->datos->id_evento."' GROUP BY eventos.id"));
                        }


                    }
                    if($sqldoc!="" && $sqldoc!=" "){
                        $dadoc=DB::select(trim($sql_base_doc.$sqldoc." GROUP BY documento,eventos.id"));  
                    }

                    if($sqlnom!="" && $sqlnom!=" "){
                        
                        $danom=DB::select(trim($sql_base_nom.$sqlnom." GROUP BY eventos.id,participantes.id"));        
                    }
                    $daterminos=DB::select(trim($sql_base_acepta_terminos.$sql_base_id.$sql.")) GROUP BY acepta_terminos"));
                    $ssql=trim(trim($sql_base_acepta_terminos.$sql_base_id.$sql.")) GROUP BY acepta_terminos"));
                     

                break;
        }
        
        if(count($res)>0){
               return array("mensaje"=>"REPORTE ",
                            "datos"=>$res,
                            "datos_genero"=>$dagen,
                            "datos_edaddes"=>$daedad,
                            "datos_dep_nac"=>$dadepnac,
                            "datos_ciu_nac"=>$daciunac,
                            "datos_ver_nac"=>$davernac,
                            "datos_dep_ubi"=>$dadepubi,
                            "datos_ciu_ubi"=>$daciuubi,
                            "datos_ver_ubi"=>$daverubi,
                            "datos_cap_dife"=>$dacapdif,
                            "datos_etnia"=>$daetnia,
                            "datos_sub_etnia"=>$dasubetnia,
                            "datos_escolaridad"=>$daescolaridad,
                            "datos_titulo_obt"=>$datitulo,
                            "datos_organizacion"=>$daorga,
                            "datos_proceso"=>$daproc,
                            "datos_doc"=>$dadoc,
                            "datos_nom"=>$danom,
                            "eventos"=>$datbleventos,
                            "zonas"=>$dazona,
                            "anio_ingreso_pdp"=>$daanioingreso,
                            "cargo_poblador"=>$dacargo,
                            "acepta_terminos"=>$daterminos,
                            "sql"=>$ssql.":(",
                            "respuesta"=>true); 

        }else{
            return array("mensaje"=>"REPORTE ".$datos->datos->id_evento." sin datos que mostrar",
                    "respuesta"=>false,"sql"=>trim($sql_base.$sql.") GROUP BY id")); 
        }
    	
    	
    	
    }

    
}
