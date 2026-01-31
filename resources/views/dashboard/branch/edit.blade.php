@php
    $model = $branch;
    $fields = [
        ['name' => 'name', 'type' => 'text', 'required' => true, 'columnClass' => 'col-12'],
        ['name' => 'phone', 'type' => 'text', 'required' => true],
        ['name' => 'email', 'type' => 'email'],
        ['name' => 'password', 'type' => 'password'], 
        ['name' => 'password_confirmation', 'type' => 'password'],
    ];
    $columnClass = 'col-12 col-lg-6';
@endphp

@include('dashboard.layouts.pages.edit')