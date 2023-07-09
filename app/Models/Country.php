<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';
    protected $primaryKey = 'id';
    protected $guarded = [];

    private array $continents = array(
        'AF' => 'Afrika',
        'AN' => 'Antartika',
        'AS' => 'Asya',
        'EU' => 'Avrupa',
        'OC' => 'Avustralya',
        'NA' => 'Kuzey Amerika',
        'SA' => 'Güney Amerika'
    );

    public function getContinentName(){
        return $this->continents[$this->continent_code];
    }
}
