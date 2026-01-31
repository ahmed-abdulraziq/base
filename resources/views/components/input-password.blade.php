@props(['name', 'label' => '', 'required' => false])

<x-input :name="$name" type="password" :label="$label" :required="$required" />
