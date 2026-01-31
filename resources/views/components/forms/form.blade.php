@props([
    'model' => null,
    'route',
    'method' => 'POST',
    'submitText' => __('translate.save'),
    'formClass' => '',
    'submitButtonClass' => 'btn-primary',
    'title' => null,
    'noCard' => false,
])

<form action="{{ route($route, $model ? $model : null) }}" method="POST" class="{{ $formClass }}"
    enctype="multipart/form-data">
    @csrf
    @method($method)

    @if ($errors->any())
        <div class="mb-3">
            @foreach ($errors->all() as $error)
                <span class="text-danger fw-bold">{{ $error }}</span><br>
            @endforeach
        </div>
    @endif

    @if ($noCard)
        <div class="card-header">
            <h3 class="card-title mb-0">
                {{ $title ?? $submitText }}
            </h3>
        </div>
        <div class="card-body border-bottom py-3">
            <div class="row">
                {{ $slot }}
            </div>
        </div>
        <div class="card-footer d-flex align-items-center">
            <button type="submit" class="btn btn-primary">
                {{ $submitText }}
            </button>
        </div>
    @else
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ $title ?? $submitText }}
                </h3>
            </div>
            <div class="card-body border-bottom py-3">
                <div class="row">
                    {{ $slot }}
                </div>
            </div>
            <div class="card-footer d-flex align-items-center">
                <button type="submit" class="btn btn-primary">
                    {{ $submitText }}
                </button>
            </div>
        </div>
    @endif
</form>
