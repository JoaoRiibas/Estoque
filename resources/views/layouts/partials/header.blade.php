<div class="page-header {{ $pb ?? '' }}">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-md-6">
                    <h4 class="text-white d-inline-block mb-0">{{ $title ?? 'erro' }}</h4>
                </div>
                <div class="col-md-6">
                    @include('layouts.response')
                </div>
            </div>
        </div>
    </div>
</div>