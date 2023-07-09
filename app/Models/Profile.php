<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getFullName(): string{
        return $this->firstname . ' ' . $this->lastname;
    }


    public function getGender(){
        return config('values.genders')[$this->gender] ?? 'Belirtilmedi';
    }

}
