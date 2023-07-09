<?php
namespace App\Helpers;

class FlashMessage{

    public static function set($message, $type='success', $icon=null):void{
        $datas = [
            'type'      => $type,
            'icon'      => $icon,
            'message'   => $message
        ];
        session()->flash('flash_message',  $datas);
    } // set

    public static function get():string{

        if(session()->has('flash_message')){
            $datas = session()->get('flash_message', []);
            $icon = $datas['icon'] ?? null;

            return '<div class="alert alert-'.($datas['type']).'">'.($icon).($datas['message']).'</div>';
        }

        return '';
    } // get

}
?>
