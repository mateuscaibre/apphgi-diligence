<?php

namespace App\Helper;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class Helper

{
    use LivewireAlert;

    public static function alertToast(String $type, String $mensagem)
    {

        return app()->alert($type, $mensagem, [
            'position' => 'center',
            'timer' => 2000,
            'toast' => false,
        ]);
    }

    public static function teste(){
        return dd("Teste Helper");
    }
}
