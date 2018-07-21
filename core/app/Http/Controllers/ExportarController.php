<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Maatwebsite\Excel\Facades\Excel;

use App\reportes;

class ExportarController extends Controller
{
    //

    public function exportar_lista(Request $requests){
    	$datos=json_decode($requests->get("datos"));
    	$nombre_reporte="lista_de_asistentes";
    	 $reportes=new reportes();
        $r=$reportes->reporte_lista($datos);
        //var_dump($r);
        //echo  substr(base_path(),0,-4);
        //ruta localhost => C:\xampp\htdocs\api_biometric\
        $arr_repo=[];
        $arr_repo1=[];
        $arr_repo2=[];
        $arr_repo3=[];
        $arr_repo4=[];
        $arr_repo5=[];
        $arr_repo6=[];
        $arr_repo7=[];
        $arr_repo8=[];
        $arr_repo9=[];
        $arr_repo10=[];
        $arr_repo11=[];
         $arr_repo12=[];
        $i=0;
        if($r["respuesta"]!=false){
                foreach ($r["datos"] as $key => $value) {
               
                    $arr_repo[$i]=(array)$value;
                                    $i++;
            
                                
                }
                $i=0;
                foreach ($r["datos_genero"] as $key => $value) {
                   
                        $arr_repo1[$i]=(array)$value;
                                        $i++;
                    
                                        
                }
                //var_dump($arr_repo1);
                $i=0;
                foreach ($r["datos_edaddes"] as $key => $value) {
                   
                        $arr_repo2[$i]=(array)$value;
                                        $i++;
                    
                                        
                }

               foreach ($r["datos_dep_nac"] as $key => $value) {
               
                    $arr_repo3[$i]=(array)$value;
                                    $i++;
            
                                
                }
                $i=0;
                foreach ($r["datos_ciu_nac"] as $key => $value) {
                   
                        $arr_repo4[$i]=(array)$value;
                                        $i++;
                    
                                        
                }
                //var_dump($arr_repo1);
                $i=0;
                foreach ($r["datos_cap_dife"] as $key => $value) {
                   
                        $arr_repo5[$i]=(array)$value;
                                        $i++;
                    
                                        
                }

                foreach ($r["datos_etnia"] as $key => $value) {
               
                    $arr_repo6[$i]=(array)$value;
                                    $i++;
            
                                
                }
                $i=0;
                foreach ($r["datos_sub_etnia"] as $key => $value) {
                        if($value->sub_etnia!=NULL){
                            $arr_repo7[$i]=(array)$value;
                                        $i++;
                        }
                        
                    
                                        
                }
                //var_dump($arr_repo1);
                $i=0;
                foreach ($r["datos_escolaridad"] as $key => $value) {
                   
                        $arr_repo8[$i]=(array)$value;
                                        $i++;
                    
                                        
                }
                foreach ($r["datos_organizacion"] as $key => $value) {
               
                    $arr_repo9[$i]=(array)$value;
                                    $i++;
            
                                
                }
                $i=0;
                foreach ($r["datos_proceso"] as $key => $value) {
                   
                        $arr_repo10[$i]=(array)$value;
                                        $i++;
                    
                                        
                }
                //var_dump($arr_repo1);
                $i=0;
                foreach ($r["datos_doc"] as $key => $value) {
                   
                        $arr_repo11[$i]=(array)$value;
                                        $i++;
                    
                                        
                }
                foreach ($r["datos_nom"] as $key => $value) {
                    //var_dump($value);
                    $arr_repo12[$i]=(array)$value;
                                    $i++;
            
                                
                }
                
                 Excel::create($nombre_reporte, function($excel) use($arr_repo,$arr_repo1,$arr_repo2,$arr_repo3,$arr_repo4,$arr_repo5,$arr_repo6,$arr_repo7,$arr_repo8,$arr_repo9,$arr_repo10,$arr_repo11,$arr_repo12,$datos){
                                 // use($datos->datos->nombre_reporte)   
                                $excel->sheet('asistentes',function($sheet) use($arr_repo){
                                    $sheet->fromArray($arr_repo);
                                });
                               
                                $excel->sheet('Genero',function($sheet) use($arr_repo1){
                                     $sheet->fromArray($arr_repo1);
                                });  
                                 $excel->sheet('Edades',function($sheet) use($arr_repo2){
                                     $sheet->fromArray($arr_repo2);
                                });  
                                $excel->sheet('Departamento de nacimiento',function($sheet) use($arr_repo3){
                                     $sheet->fromArray($arr_repo3);
                                });  
                                 $excel->sheet('Ciudad nacimiento',function($sheet) use($arr_repo4){
                                     $sheet->fromArray($arr_repo4);
                                });  
                                $excel->sheet('Capacidades diferentes',function($sheet) use($arr_repo5){
                                     $sheet->fromArray($arr_repo5);
                                });  
                                 $excel->sheet('Etnia',function($sheet) use($arr_repo6){
                                     $sheet->fromArray($arr_repo6);
                                });  
                                $excel->sheet('Sub_etnias',function($sheet) use($arr_repo7){
                                     $sheet->fromArray($arr_repo7);
                                });  
                                 $excel->sheet('Escolaridad',function($sheet) use($arr_repo8){
                                     $sheet->fromArray($arr_repo8);
                                });  
                                $excel->sheet('Organizacion',function($sheet) use($arr_repo9){
                                     $sheet->fromArray($arr_repo9);
                                });  
                                 $excel->sheet('Proceso',function($sheet) use($arr_repo10){
                                     $sheet->fromArray($arr_repo10);
                                });  
                                $excel->sheet('Documento',function($sheet) use($arr_repo11){
                                     $sheet->fromArray($arr_repo11);
                                });  
                                 $excel->sheet('Nombre',function($sheet) use($arr_repo12){
                                     $sheet->fromArray($arr_repo12);
                                });  
                                

                                  
                                
                                
                                
                 })->store('xls', substr(base_path(),0,-4)."archivos/exportacion/excel");

                  echo json_encode(["mensaje"=>"Archivo exportado","respuesta"=>true,"direccion"=>"archivos/exportacion/excel/".$nombre_reporte.".xls","sql"=>$r["sql"]]);   
        }else{
            echo json_encode(["mensaje"=>"Archivo NO se ha generado","respuesta"=>false,"sql"=>$r["sql"]]);
        }
       
        
    }
}
