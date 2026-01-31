@props(['action', 'method' => 'POST', 'fields' => [], 'submitText' => __('translate.add'), 'model' => null])

<form action="{{ $action }}" method="POST">
    @csrf
    @if (strtoupper($method) !== 'POST')
        @method($method)
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ $submitText }}
            </h3>
        </div>

        <div class="card-body border-bottom py-3">
            <div class="row">
                @foreach ($fields as $field)
                    @php
                        $value = old($field['name'], $model->{$field['name']} ?? null);
                    @endphp

                    <div class="{{ $field['columnClass'] ?? 'col-12' }}">
                        @if ($field['type'] === 'select')
                            <x-select :name="$field['name']" :label="$field['label'] ?? null" :options="$field['options'] ?? []" :required="$field['required'] ?? false"
                                :value="old($field['name'], $model->{$field['name']} ?? null)" />
                        @elseif($field['type'] === 'password')
                            <x-input-password :name="$field['name']" :label="$field['label'] ?? null" :required="$field['required'] ?? false" />
                        @else
                            <x-input :type="$field['type'] ?? 'text'" :name="$field['name']" :label="$field['label'] ?? null" :required="$field['required'] ?? false"
                                :value="$value" />
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div class="card-footer d-flex align-items-center">
            <button type="submit" class="btn btn-primary">
                {{ $submitText }}
            </button>
        </div>
    </div>
</form>
