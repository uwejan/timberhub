<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{

    public array $species = [
        'Pine', 'Spruce', 'Fir', 'Birch', 'Apple Tree'
    ];

    public $grading_system = [
        'Nordic Blue' => ['A1', 'A2', 'A3', 'A4', 'B'],
        'Tegernseer' => ['O', 'I', 'II', 'III', 'IV', 'V']
    ];

    public $accepted_grading_systems = [
        'A1', 'A2', 'A3', 'A4', 'B', 'O', 'I', 'II', 'III', 'IV', 'V'
    ];

    public $accepted_drying_method = [
        'Fresh', 'Kiln Dried', 'Air Dried'
    ];


    public $accepted_treatment = [
        'Heat Treated', 'Anti-stain Treatment'
    ];


    public function validationData()
    {
        $all = parent::validationData();
        //Convert request values to lowercase
        $all = array_map("strtolower", $all);
        return $all;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'supplier_id' => [ 'required', 'numeric'],
            'species' => ['required', 'max:255', Rule::in(array_map("strtolower", $this->species))],
            'grading_system' => ['required', 'max:255', Rule::in(array_map("strtolower", $this->accepted_grading_systems))],
            'drying_method' => ['required', 'max:255', Rule::in(array_map("strtolower", $this->accepted_drying_method))],
            'treatment' => ['sometimes', 'required', 'max:255', Rule::in(array_map("strtolower", $this->accepted_treatment))],
            'thickness' => [ 'required', 'numeric', 'min:40', 'max:90'],
            'width' => [ 'required', 'numeric', 'min:90', 'max:150'],
            'length' => [ 'required', 'numeric', 'min:1200', 'max:3000'],

        ];
    }


    /**
     * Assigning proper error messages
     * */

    public function messages()
    {
        return [
            'species.in' => 'Accepted values are: ' . implode(", ",$this->species),
            'grading_system.in' => 'Accepted values are: ' . implode_recursive(', ', $this->grading_system),
            'drying_method.in' => 'Accepted values are: ' . implode(", ",$this->accepted_drying_method),
            'treatment.*' => 'OPTIONAL: Accepted values are: ' . implode(", ",$this->accepted_treatment),
        ];
    }


}
