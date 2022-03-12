{{-- parent layout: main -> index blade --}}
@extends('main.index')

@section('content')
    <section class="mt-5 py-5">
        <div class="container px-3 px-md-5">
            <div class="container">
                <div class="row align-items-center position-relative">
                    <div class="col-lg-6">
                        <h1 class="page-header-title">
                            Welcome to Barrio Puso!
                        </h1>
                        <p class="page-header-text lead">
                            {{-- A barangay that serve and help with a heart. --}}
                            Lorem ipsum dolor sit amet consectetur adipisicing.
                        </p>
                        <p class="page-header-text text-sm">
                            {{-- You can now request any documents from our barangay here and give feedback to us for the
                            betterment of our barangay and service. --}}
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto corrupti explicabo mollitia quasi labore praesentium rem fuga.
                        </p>
                    </div>
                    <div class="col-12 col-lg-6">
                        <img src="{{ url('/images/home.svg') }}" alt="Image" class="mt-5 mt-lg-0 w-100" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- anonymous component: views -> components -> modal blade --}}
    <x-modal>
        <x-slot name="title">
            Request Received
        </x-slot>

        <x-slot name="message">
            You will receive an email once your requested document is available for pick up.
        </x-slot>

        <button type="button" class="btn btn-primary px-4 form-btn btn-next border-0 main-cta" data-bs-dismiss="modal">Okay</button>
    </x-modal>
@endsection

@push('scripts')
    {{-- prevent returning to prev page --}}
    <script defer>
        (function(global) {

            if (typeof(global) === "undefined") {
                throw new Error("window is undefined");
            }

            var _hash = "!";
            var noBackPlease = function() {
                global.location.href += "#";

                global.setTimeout(function() {
                    global.location.href += "!";
                }, 50);
            };

            global.onhashchange = function() {
                if (global.location.hash !== _hash) {
                    global.location.hash = _hash;
                }
            };

            global.onload = function() {
                noBackPlease();

                document.body.onkeydown = function(e) {
                    var elm = e.target.nodeName.toLowerCase();
                    if (e.which === 8 && (elm !== 'input' && elm !== 'textarea')) {
                        e.preventDefault();
                    }
                    
                    e.stopPropagation();
                };
            }
        })(window);
    </script>
    {{-- show modal on page load --}}
    @if (\Session::has('showModal'))
        <script defer>
            $(document).ready(function() {
                $('#confirmModal').modal('show');
            });
        </script>
    @endif
@endpush
