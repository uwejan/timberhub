<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specifications extends Model
{
    use HasFactory;

    /// mass assignment
    protected $guarded = [];

    private $grading_system = [
        'A1' => 'Nordic Blue A1',
        'A2' => 'Nordic Blue A2',
        'A3' => 'Nordic Blue A3',
        'A4' => 'Nordic Blue A4',
        'B' => 'Nordic Blue B',
        'O' => 'Tegernseer O',
        'I' => 'Tegernseer I',
        'II' => 'Tegernseer II',
        'III' => 'Tegernseer III',
        'IV' => 'Tegernseer IV',
        'V' => 'Tegernseer V',
    ];


    /**
     * Get the product that owns the specification or dimension.
     */
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Products::class);
    }


    /**
     * Get the system grading.
     *
     * @param  string  $value
     * @return string
     */
/*    public function getGradingSystemAttribute(string $value): string
    {
        return $this->grading_system[strtoupper($value)];
    }*/


    /**
     * Mutating text field to upper case
     *
     * set grading_system full string
     * */

    public function setSpeciesAttribute($value)
    {
        $this->attributes['species'] = ucfirst($value);
    }

    public function setDryingMethodAttribute($value)
    {
        $this->attributes['drying_method'] = ucfirst($value);
    }

    public function setGradingSystemAttribute($value)
    {
        $this->attributes['grading_system'] = $this->grading_system[strtoupper($value)];
    }

    public function setTreatmentAttribute($value)
    {
        $this->attributes['treatment'] = ucfirst($value);
    }
}
