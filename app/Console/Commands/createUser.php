<?php

namespace App\Console\Commands;

use App\Http\Controllers\UserController;
use Illuminate\Support\Str;
use App\User;
use Exception;
use Illuminate\Console\Command;

class createUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user {username} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear un usuario indicando Username, Email y Contraseña';

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
     * @return int
     */
    public function handle()
    {

        $password = $this->secret("Ingresar Contraseña (min. 8 caracteres) :");
        $user = new User();
    
        
        try{
            $user->username = $this->argument('username');
            if(filter_var($this->argument('email'),FILTER_VALIDATE_EMAIL)){
                $user->email = $this->argument('email'); 
            } else {
                throw new Exception('El email especificado no pudo ser validado correctamente.');
            }
            if(strlen($password) >= 8){
                $user->password = bcrypt($password);
            } else {
                throw new Exception('La contraseña es demasiado corta.');
            }
            $user->save();
            $this->info('Usuario ' . $this->argument('email') . ' creado correctamente');
        } catch (Exception $e) {
            $this->info('Ocurrio el siguiente error: ' . $e);
        }
        return 0;
    }
}
