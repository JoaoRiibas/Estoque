<div class="modal-dialog {{ $size ?? 'modal-lg' }}">
    @if(isset($formroute))
    <form action="{{ $formroute }}" class="axios-form" method="post">@csrf
    @endif

    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $title ?? 'NO TITULO' }}</h5>
            {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
        </div>


        <div class="modal-body">
            @yield('content')
        </div>

        <div class="modal-footer " style="justify-content: space-between">
            @yield('footer')
        </div>

    </div>
    @yield('closeform')

    @if(isset($formroute))
    </form>
    @endif
    @stack('scripts')
</div>