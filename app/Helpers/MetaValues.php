<?php

namespace App\Helpers;

class MetaValues
{

    /**
     * @param $metaValues
     * @return void
     * title => meta title
     * icon => Breadcrumb Icon
     */

    public static function set($titleOrValues=[], $icon=null): void{
        if($icon){
            $GLOBALS['META_VALUES']['icon'] = $icon;
        }

        if(is_array($titleOrValues)){
            foreach($titleOrValues as $key => $value){
                $GLOBALS['META_VALUES'][$key] = $value;
            }
        }else{
            $GLOBALS['META_VALUES']['title'] = $titleOrValues;
        }

    } // set

}
