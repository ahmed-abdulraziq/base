<div class="col-12">
    <div class="top">
        <div class="title">
            <h1 class="page-title">@yield('header')</h1>
        </div>
        <div class="pagination-box">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @foreach ($breadcrumbs as $breadcrumb)
                    @if ($breadcrumb->url && !$loop->last)
                        <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page" >
                            {{ $breadcrumb->title }}
                        </li>
                    @endif
                @endforeach
            </ol>
        </nav>
        </div>
    </div>
</div>
<div class="col-12">
    @include('dashboard.layouts.notifications.status')
</div>
