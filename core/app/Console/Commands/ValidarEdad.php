<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;



class ValidarEdad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'validar_edad';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando que valida que se realice la actualizacion de la edad';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $tz_object = new DateTimeZone('America/Bogota');
        $hoy=new DateTime();
        $hoy->setTimezone($tz_object);

        $now=$hoy->format('m\-d\ ');
        DB::table("participantes")->where("fecha_nac","LIKE","%-".trim($now))->increment("edad",1);
    }
}
