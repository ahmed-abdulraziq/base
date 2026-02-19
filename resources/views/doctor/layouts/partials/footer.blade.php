<footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
        <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                        &copy; {{ date('Y') }} <a href="{{ url('/') }}" class="link-secondary">{{ config('app.name') }}</a>. {{ __('translate.all_rights_reserved') }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
