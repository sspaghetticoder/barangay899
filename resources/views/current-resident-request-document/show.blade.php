@extends('main.index')

@section('nav-bar')
    {{-- anonymous component: views -> components -> header blade --}}
    <x-header>
        <li class="nav-item">
            <a class="nav-link ms-4 d-none d-sm-block" href="{{ route('home') }}">Home</a>
            <a class="nav-link ms-4 d-block d-sm-none" href="{{ route('home') }}">
                <svg xmlns="http://www.w3.org/2000/svg" strokeWidth="2" width="18" height="18" fill="currentColor"
                    class="bi bi-house" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                    <path fill-rule="evenodd"
                        d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                </svg>
            </a>
        </li>
    </x-header>
@endsection

@section('content')
    <section class="position-relative" style="min-height: 100vh;">
        <div class="container px-3 px-md-5 position-relative">
            <div class="row px-0 px-lg-5">
                <h2 class="text-center mt-5 pt-5"><b>Request Confirmation</b></h2>
                <p class="text-left"><b>Summary of Request</b></p>
            </div>

            <form id="requests.confirm" action="{{ route('requests.confirm', $modelsRequest) }}" method="POST"
                class="row g-2 px-0 px-lg-5">
                @csrf
                @if (in_array("b", $modelsRequest->documents->pluck('document_type')->toArray()))
                <div class="col-12 col-md-8 ps-lg-5">
                    <label class=""><b>Fullname</b></label>
                    <p class="ps-4">{{ $modelsRequest->fullName ?? 'N/A' }}</p>
                </div>

                <div class="col-12 col-md-4">
                    <label><b>Address</b></label>
                    <p class="ps-4">{{ $modelsRequest->address ?? 'N/A' }}</p>
                </div>

                <div class="col-12 col-md-8 ps-lg-5">
                    <label><b>Email Address</b></label>
                    <p class="ps-4">{{ $modelsRequest->email_add ?? 'N/A' }}</p>
                </div>

                <div class="col-12 col-md-4">
                    <label><b>Contact Number</b></label>
                    <p class="ps-4">{{ $modelsRequest->contact_number_formatted ?? 'N/A' }}</p>
                </div>

                <div class="col-12 col-md-8 ps-lg-5">
                    <label><b>Barangay Documents</b></label>
                    <p class="ps-4">
                        @foreach ($modelsRequest->documents as $document)
                            {{ $loop->first ? '' : ', ' }}
                            <span>{{ $document->name ?? 'N/A' }}</span>
                        @endforeach
                    </p>
                </div>

                <div class="col-12 {{ in_array("b", $modelsRequest->documents->pluck('document_type')->toArray()) ? "col-md-4" : "col-md-5 col-xl-4" }}">
                    <label><b>Purpose</b></label>
                    <p class="ps-4">
                        @foreach ($modelsRequest->purposes as $document)
                            {{ $loop->first ? '' : ', ' }}
                            <span>{{ $document ?? 'N/A' }}</span>
                        @endforeach
                    </p>
                </div>
                @else
                <div class="col-12 col-md-6 ps-lg-5">
                    <label class=""><b>Fullname</b></label>
                    <p class="ps-4">{{ $modelsRequest->fullName ?? 'N/A' }}</p>
                </div>

                <div class="col-12 col-md-6">
                    <label><b>Address</b></label>
                    <p class="ps-4">{{ $modelsRequest->address ?? 'N/A' }}</p>
                </div>

                <div class="col-12 col-md-6 ps-lg-5">
                    <label><b>Email Address</b></label>
                    <p class="ps-4">{{ $modelsRequest->email_add ?? 'N/A' }}</p>
                </div>

                <div class="col-12 col-md-6">
                    <label><b>Contact Number</b></label>
                    <p class="ps-4">{{ $modelsRequest->contact_number_formatted ?? 'N/A' }}</p>
                </div>

                <div class="col-12 col-md-6 ps-lg-5">
                    <label><b>Barangay Documents</b></label>
                    <p class="ps-4">
                        @foreach ($modelsRequest->documents as $document)
                            {{ $loop->first ? '' : ', ' }}
                            <span>{{ $document->name ?? 'N/A' }}</span>
                        @endforeach
                    </p>
                </div>

                <div class="col-12 {{ in_array("b", $modelsRequest->documents->pluck('document_type')->toArray()) ? "col-md-6" : "col-md-5 col-xl-4" }}">
                    <label><b>Purpose</b></label>
                    <p class="ps-4">
                        @foreach ($modelsRequest->purposes as $document)
                            {{ $loop->first ? '' : ', ' }}
                            <span>{{ $document ?? 'N/A' }}</span>
                        @endforeach
                    </p>
                </div>
                @endif

                @foreach ($modelsRequest->documents as $document)
                    @if ($document->business_permit)
                        <div class="col-12">
                            <h2 class="text-center mt-2" style="border-top: 1px solid #00BBD9;"><b>&nbsp;</b></h2>
                            <p class="text-left text-capitalize"><b>Business Permit Details</b></p>
                        </div>
        
                        <div class="col-12 col-md-6 ps-lg-5">
                            <label class=""><b>Business Name</b></label>
                            <p class="ps-4">{{ $document->business_permit->business_name ?? 'N/A' }}</p>
                        </div>
        
                        <div class="col-12 col-md-6">
                            <label class=""><b>Business Owner</b></label>
                            <p class="ps-4">{{ $document->business_permit->business_owner ?? 'N/A' }}</p>
                        </div>
        
                        <div class="col-12 col-md-6 ps-lg-5">
                            <label class=""><b>Business Address</b></label>
                            <p class="ps-4">{{ $document->business_permit->business_add ?? 'N/A' }}</p>
                        </div>
        
                        <div class="col-12 col-md-6">
                            <label class=""><b>Business Nature</b></label>
                            <p class="ps-4">{{ $document->business_permit->business_nature ?? 'N/A' }}</p>
                        </div>
                    @endif
                @endforeach

                <div class="col-12">
                    <div class="row position-relative">
                        <div class="col-12 col-lg-10 col-xl-9 d-flex flex-row align-items-start">
                            <input class="m-2" type="checkbox" name="certify" id="certify" />
                            <label class="" for="certify" class="">I hereby certify that the
                                above information given
                                are <b>true
                                    and correct</b>. And <b>I consent Barangay 899</b>
                                under the standards of Data Proctection and Privacy Act to
                                <b>collect and process</b> the given
                                information.</label>
                        </div>

                        <div class="col-12 col-lg-6 pt-5">
                            <div class="row">
                                <div class="col-12 col-md-3 col-lg-4">
                                    <a href="{{ route('current_resident.requests.edit', $modelsRequest->resident).$url }}" class="w-100 btn btn-primary form-btn btn-cancel main-cta">Cancel</a>
                                </div>
                                <div class="col-12 col-md-3 mt-2 mt-md-0 col-lg-4 ">
                                    <input type="submit" class="w-100 btn btn-primary form-btn btn-next border-0 main-cta"
                                        value=" Submit " id="submit-btn" form="requests.confirm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="confirm-img">
                <img src="{{ url('images/request-confirm.png') }}" alt="photo" class="" style="">
            </div>

            <footer class="confirm-footer" id="footer" style="">
                <div class="mb-5">
                    <p>Copyright © 2021 Barangay 899. All rights reserved.</p>
                </div>
            </footer>

            <x-modal>
                <x-slot name="title">
                    @if (\Session::has('Exception'))
                        {{ \Session::get('Exception')['title'] ?? 'N/A' }}
                    @else
                        Please Confirm
                    @endif
                </x-slot>

                <x-slot name="message">
                    @if (\Session::has('Exception'))
                        {{ \Session::get('Exception')['message'] ?? 'N/A' }}
                    @else
                        To continue, please confirm below that the information you gave are true and correct.
                    @endif
                </x-slot>

                @if (\Session::has('Exception'))
                    <button type="button" class="btn btn-primary px-4 form-btn btn-next"
                        data-bs-dismiss="modal">Close</button>
                @else
                    <button type="button" class="btn btn-primary form-btn btn-next border-0 main-cta" data-bs-toggle="modal"
                        data-bs-target="#confirmModal">
                        Okay
                    </button>
                @endif
            </x-modal>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ url('js/certify.js') }}"></script>

    @error('certify')
        <script defer>
            $(document).ready(function() {
                $('#confirmModal').modal('show');
            });
        </script>
    @enderror
@endpush
