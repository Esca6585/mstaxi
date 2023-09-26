<?php

return [

    /*
    |--------------------------------------------------------------------------
    | ru Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'accepted' => ':attribute должен быть принят.',
    'active_url' => ':attribute не является допустимым URL.',
    'after' => ':attribute должен быть датой после :date.',
    'after_or_equal' => ':attribute должен быть датой после или равной :date.',
    'alpha' => ':attribute должен содержать только буквы.',
    'alpha_dash' => ':attribute должен содержать только буквы, цифры, дефисы и подчеркивания.',
    'alpha_num' => ':attribute должен содержать только буквы и цифры.',
    'array' => ':attribute должен быть массивом.',
    'before' => ':attribute должен быть датой перед :date.',
    'before_or_equal' => ':attribute должен быть датой до или равной :date.',
    'between' => [
        'numeric' => ':attribute должен находиться в диапазоне от :min до :max.',
        'file' => ':attribute должен находиться в диапазоне от :min до :max килобайт.',
        'string' => ':attribute должен содержать символы :min и :max.',
        'array' => ':attribute должен содержать от :min до :max элементов.',
    ],
    'boolean' => 'Поле :attribute должно быть истинным или ложным.',
    'confirmed' => 'Подтверждение :attribute не совпадает.',
    'current_password' => 'Пароль неверен.',
    'date' => ':attribute не является допустимой датой.',
    'date_equals' => ':attribute должен быть датой, равной :date.',
    'date_format' => ':attribute не соответствует формату :format.',
    'different' => ':attribute и :other должны отличаться.',
    'digits' => ':attribute должен быть :digits цифрами.',
    'digits_between' => ':attribute должен быть между :min и :max цифрами.',
    'dimensions' => ':attribute имеет недопустимые размеры изображения.',
    'distinct' => 'Поле :attribute имеет повторяющееся значение.',
    'email' => ':attribute должен быть действительным адресом электронной почты.',
    'ends_with' => ':attribute должен заканчиваться одним из следующих :values.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => ':attribute должен быть меньше :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => ':attribute :value nyşanlardan uly bolmaly däldir.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => ':attribute должен быть меньше или равен :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute must not be greater than :max.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'string' => 'The :attribute must not be greater than :max characters.',
        'array' => 'The :attribute must not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => ':attribute должен быть не меньше :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => ':attribute должен содержать не менее :min символов.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => ':attribute является обязательным.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => ':attribute уже занят.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute must be a valid URL.',
    'uuid' => 'The :attribute must be a valid UUID.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'first_name' => 'Имя',
        'last_name' => 'Фамилия',
        'email' => 'Электронная почта',
        'password' => 'Пароль',
    ],

];
