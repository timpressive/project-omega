<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute moet worden geaccepteerd.',
    'active_url'           => ':attribute is geen geldige URL.',
    'after'                => ':attribute moet een datum zijn na :date.',
    'alpha'                => ':attribute mag enkel uit letters bestaan.',
    'alpha_dash'           => ':attribute mag enkel bestaan uit letters, cijfers, and koppeltekens.',
    'alpha_num'            => ':attribute mag enkel bestaan uit letters en cijfers.',
    'array'                => ':attribute moet een array zijn',
    'before'               => ':attribute moet een datum zijn voor :date.',
    'between'              => [
        'numeric' => ':attribute moet tussen :min en :max liggen.',
        'file'    => ':attribute moet tussen :min en :max kilobytes bevatten.',
        'string'  => ':attribute moet tussen :min en :max characters bevatten.',
        'array'   => ':attribute moet tussen :min en :max items bevatten.',
    ],
    'boolean'              => ':attribute moet TRUE of FALSE zijn.',
    'confirmed'            => ':attribute bevestiging komt niet overeen.',
    'date'                 => ':attribute is geen geldige datum.',
    'date_format'          => ':attribute is niet van het format :format.',
    'different'            => ':attribute en :other mogen niet gelijk zijn.',
    'digits'               => ':attribute moet :digits cijfers zijn.',
    'digits_between'       => ':attribute moet tussen :min en :max cijfers zijn.',
    'email'                => ':attribute moet een geldig e-mailadres zijn.',
    'exists'               => 'Geselecteerd :attribute is ongeldig.',
    'filled'               => ':attribute veld is verplicht.',
    'image'                => ':attribute moet een afbeelding zijn.',
    'in'                   => 'Geselecteerd :attribute is ongeldig.',
    'integer'              => ':attribute moet een geheel getal zijn.',
    'ip'                   => ':attribute moet een geldig IP adres zijn.',
    'json'                 => ':attribute moet een geldige JSON string zijn.',
    'max'                  => [
        'numeric' => ':attribute mag niet groter zijn dan :max.',
        'file'    => ':attribute mag niet groter zijn dan :max kilobytes.',
        'string'  => ':attribute attribute mag niet groter zijn dan :max characters.',
        'array'   => ':attribute attribute mag niet groter zijn dan :max items.',
    ],
    'mimes'                => ':attribute moet een bestand zijn van type: :values.',
    'min'                  => [
        'numeric' => ':attribute moet minstens :min zijn.',
        'file'    => ':attribute moet minstens :min kilobytes groot zijn.',
        'string'  => ':attribute moet minstens :min characters lang zijn.',
        'array'   => ':attribute moet minstens :min items bevatten.',
    ],
    'not_in'               => ':attribute is ongeldig.',
    'numeric'              => ':attribute moet een numerische waarde zijn.',
    'regex'                => ':attribute formaat is ongeldig.',
    'required'             => ':attribute is verplicht.',
    'required_if'          => ':attribute is verplicht als :other :value is.',
    'required_unless'      => ':attribute is verplicht tenzij :other in :values zit.',
    'required_with'        => ':attribute is verplicht als :values ingevuld is.',
    'required_with_all'    => ':attribute is verplicht als :values ingevuld is.',
    'required_without'     => ':attribute is verplicht als :values niet is ingevuld.',
    'required_without_all' => ':attribute is verplicht als geen van de volgende aanwezig zijn\: :values.',
    'same'                 => ':attribute and :other must match.',
    'size'                 => [
        'numeric' => ':attribute moet :size groot zijn.',
        'file'    => ':attribute moet :size kilobytes groot zijn.',
        'string'  => ':attribute moet :size karakters lang zijn.',
        'array'   => ':attribute must contain :size items.',
    ],
    'string'               => ':attribute moet een tekstwaarde zijn.',
    'timezone'             => ':attribute moet een geldige tijdzone zijn.',
    'unique'               => ':attribute is al in gebruik.',
    'url'                  => ':attribute formaat is ongeldig.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
