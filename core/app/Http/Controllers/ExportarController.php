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
        $arr_repo_eve=[];
        $arr_zona=[];
        $arr_cargo=[];
        $arr_anio_ing=[];
        $arr_ver_nac=[];
        $arr_dep_ubi=[];
        $arr_ciu_ubi=[];
        $arr_ver_ubi=[];
        $arr_titulo=[];
        $i=0;
        if($r["respuesta"]!=false){
                foreach ($r["datos"] as $key => $value) {
               
                    $arr_repo[$i]=(array)$value;
                                    $i++;
            
                                
                }
                //var_dump($r["eventos"]);                
                $i=0;
                foreach ($r["eventos"] as $key => $value) {
               
                    $arr_repo_eve[$i]=(array)$value;
                                $i++;
            
                                
                }
                $i=0;
                foreach ($r["zonas"] as $key => $value) {
               
                    $arr_zona[$i]=(array)$value;
                                $i++;
            
                                
                }
                $i=0;
                foreach ($r["anio_ingreso_pdp"] as $key => $value) {
               
                    $arr_anio_ing[$i]=(array)$value;
                                $i++;
            
                                
                }
                $i=0;
                foreach ($r["cargo_poblador"] as $key => $value) {
               
                    $arr_cargo[$i]=(array)$value;
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
                $i=0;
                foreach ($r["datos_dep_nac"] as $key => $value) {
               
                    $arr_repo3[$i]=(array)$value;
                                    $i++;            
                                
                }
                $i=0;
                foreach ($r["datos_ciu_nac"] as $key => $value) {
                   
                        $arr_repo4[$i]=(array)$value;
                                        $i++;            
                                        
                }
                $i=0;
                foreach ($r["datos_ver_nac"] as $key => $value) {
                   
                        $arr_ver_nac[$i]=(array)$value;
                                        $i++;            
                                        
                }
                $i=0;
                foreach ($r["datos_dep_ubi"] as $key => $value) {
               
                    $arr_dep_ubi[$i]=(array)$value;
                                    $i++;            
                                
                }
                $i=0;
                foreach ($r["datos_ciu_ubi"] as $key => $value) {
                   
                        $arr_ciu_ubi[$i]=(array)$value;
                                        $i++;            
                                        
                }
                $i=0;
                foreach ($r["datos_ver_ubi"] as $key => $value) {
                   
                        $arr_ver_ubi[$i]=(array)$value;
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
                $i=0;
                foreach ($r["datos_titulo_obt"] as $key => $value) {
                   
                        $arr_titulo[$i]=(array)$value;
                                        $i++;
                    
                                        
                }
                $i=0;
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
                
                 Excel::create($nombre_reporte, function($excel) use($arr_repo,$arr_repo1,$arr_repo2,$arr_repo3,$arr_repo4,$arr_repo5,$arr_repo6,$arr_repo7,$arr_repo8,$arr_repo9,$arr_repo10,$arr_repo11,$arr_repo12,$datos,$arr_repo_eve,$arr_zona,$arr_anio_ing,$arr_cargo,$arr_ver_nac,$arr_dep_ubi,$arr_ciu_ubi,$arr_ver_ubi,$arr_titulo){
                                
                                $excel->sheet('Eventos',function($sheet) use($arr_repo_eve){
                                    $sheet->fromArray($arr_repo_eve);
                                });

                                $excel->sheet('Asistentes',function($sheet) use($arr_repo){
                                    $sheet->fromArray($arr_repo);
                                });
                                $excel->sheet('Año ingreso PDP',function($sheet) use($arr_anio_ing){
                                     $sheet->fromArray($arr_anio_ing);
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
                                $excel->sheet('Vereda nacimiento',function($sheet) use($arr_ver_nac){
                                     $sheet->fromArray($arr_ver_nac);
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
                                $excel->sheet('Título Obtenido',function($sheet) use($arr_titulo){
                                     $sheet->fromArray($arr_titulo);
                                });  
                                $excel->sheet('Organizacion',function($sheet) use($arr_repo9){
                                     $sheet->fromArray($arr_repo9);
                                });  
                                $excel->sheet('Proceso',function($sheet) use($arr_repo10){
                                     $sheet->fromArray($arr_repo10);
                                });
                                $excel->sheet('Zonas',function($sheet) use($arr_zona){
                                     $sheet->fromArray($arr_zona);
                                });
                                $excel->sheet('Departamento de ubicación',function($sheet) use($arr_dep_ubi){
                                     $sheet->fromArray($arr_dep_ubi);
                                });  
                                $excel->sheet('Ciudad ubicación',function($sheet) use($arr_ciu_ubi){
                                     $sheet->fromArray($arr_ciu_ubi);
                                });
                                $excel->sheet('Vereda ubicación',function($sheet) use($arr_ver_ubi){
                                     $sheet->fromArray($arr_ver_ubi);
                                });  
                                $excel->sheet('Cargo Poblador',function($sheet) use($arr_cargo){
                                     $sheet->fromArray($arr_cargo);
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
