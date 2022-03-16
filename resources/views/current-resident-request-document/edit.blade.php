@extends('main.index')

@section('nav-bar')
    {{-- anonymous component: views -> components -> header blade --}}
    <x-header>
        <li class="nav-item">
            <a class="nav-link ms-4 d-none d-sm-block" href="{{ route('home') }}">Home</a>
            <a class="nav-link ms-4 d-block d-sm-none" href="{{ route('home') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-house"
                    viewBox="0 0 16 16">
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
    <section class="pt-5 position-relative" style="min-height: 100vh;">
        <div class="container px-3 px-md-5 position-relative" style="min-height: 90vh;">
            <div class="row px-0 px-lg-5">
                <h2 class="text-center mt-5"><b>Request Documents</b></h2>
                <p class="text-left">Please fill out all the necessary fields.</p>
            </div>

            <form id="requests.destroy" action="{{ route('current_resident.requests.destroy', $latestRequest) }}"
                method="POST">
                @method('DELETE')
                @csrf
            </form>

            <form action="{{ route('current_resident.requests.update', $latestRequest) }}" method="POST"
                class="row g-4 px-0 px-lg-5">
                @method('PATCH')
                @csrf
                <div style="display: none;">
                    <input type="text" id="PreventChromeAutocomplete" name="PreventChromeAutocomplete"
                        autocomplete="address-level4" />
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('last_name') is-invalid @enderror grayed"
                        name="last_name" placeholder="Lastname" value="{{ old('last_name') ?? $resident->last_name }}"
                        required>

                    @error('last_name')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('first_name') is-invalid @enderror grayed"
                        name="first_name" placeholder="Firstname" value="{{ old('first_name') ?? $resident->first_name }}"
                        required>

                    @error('first_name')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <label for="middle_name" class="notice" style="font-size: 11px;"><span
                            class="text-danger"><b>*</b></span>Put N/A if not applicable.</label>

                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('middle_name') is-invalid @enderror grayed"
                        name="middle_name" id="middle_name" placeholder="Middlename"
                        value="{{ old('middle_name') ?? $resident->middle_name }}" required>

                    @error('middle_name')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off" class="form-control border border-secondary grayed"
                        name="suffix" placeholder="Suffix(Optional)" value="{{ old('suffix') ?? $resident->suffix }}">
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('house_number') is-invalid @enderror grayed"
                        name="house_number" placeholder="House Number"
                        value="{{ old('house_number') ?? $resident->house_number }}" required>

                    @error('house_number')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('street') is-invalid @enderror grayed"
                        name="street" placeholder="Street" value="{{ old('street') ?? $resident->street_name }}"
                        required>

                    @error('street')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="email" autocomplete="off" title="Example: sample@gmail.com"
                        pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$"
                        class="form-control border border-secondary @error('email_add') is-invalid @enderror grayed"
                        name="email_add" placeholder="Email Address"
                        value="{{ old('email_add') ?? $resident->email_add }}" required>
                    @error('email_add')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="text"
                        class="form-control border border-secondary @error('contact_number') is-invalid @enderror grayed"
                        name="contact_number" placeholder="Contact Number"
                        value="{{ old('contact_number') ?? $resident->contact_no }}" required>

                    @error('contact_number')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 d-block d-md-none">
                    <label for="multiselect-wrapper" class="position-relative"
                        style="font-size: 11px; word-wrap: break-word;"><span class="text-danger"><b>*</b></span>Please
                        specify the purpose if you are requesting for more than 1(one) document on the “others”
                        field.</label>
                </div>

                <div class="col-12 col-lg-9 position-relative">
                    <label for="multiselect-wrapper" class="notice d-none d-md-block"
                        style="font-size: 11px; word-wrap: break-word;"><span class="text-danger"><b>*</b></span>Please
                        specify the purpose if you are requesting for more than 1(one) document on the “others”
                        field.</label>

                    <div class="multiselect-wrapper">
                        <div class="position-relative select-list" style="height: min-content">
                            <div class="title title-barangay-documents">Select any barangay document you want to request
                            </div>
                            <div class="select-options">
                                <div class="option">
                                    <input type="checkbox" name="cor" id="cor" value="r"
                                        data-document="Certificate of Residency"
                                        class="barangay-document custom-dropdown-option"
                                        @if (old('cor')) checked @endif />
                                    <label for="cor">Certificate of Residency</label>
                                </div>
                                <div class="option">
                                    <input type="checkbox" name="coi" id="coi" value="i"
                                        data-document="Certificate of Indigency"
                                        class="barangay-document custom-dropdown-option"
                                        @if (old('coi')) checked @endif />
                                    <label for="coi">Certificate of Indigency</label>
                                </div>
                                <div class="option">
                                    <input type="checkbox" name="bc" id="bc" value="c" data-document="Barangay Clearance"
                                        class="barangay-document custom-dropdown-option"
                                        @if (old('bc')) checked @endif />
                                    <label for="bc">Barangay Clearance</label>
                                </div>
                                <div class="option">
                                    <input type="checkbox" name="bp" id="bp" value="b" data-document="Business Permit"
                                        class="barangay-document business-permit custom-dropdown-option"
                                        @if (old('bp')) checked @endif />
                                    <label for="bp">Business Permit</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (\Session::has('require_document'))
                        <div class="position-relative">
                            <div class="custom-dropdown-error"
                                style="position: absolute; top: 2px; background: #DE4856; border-radius: 5px; padding: 5px; color: white; font-size: 13px; z-index: 666;">
                                {!! \Session::get('require_document') !!}
                            </div>
                        </div>
                    @endif
                </div>


                <div
                    class="col-12 col-sm-6 col-lg-4 position-relative business-permit-input @if (!old('bp')) d-none @endif">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('business_name') is-invalid @enderror grayed"
                        name="business_name"
                        value="{{ old('business_name') ? old('business_name') : $document->business_permit->business_name ?? '' }}"
                        placeholder="Business Name">

                    @error('business_name')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div
                    class="col-12 col-sm-6 col-lg-5 position-relative business-permit-input @if (!old('bp')) d-none @endif">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('business_owner') is-invalid @enderror grayed"
                        name="business_owner"
                        value="{{ old('business_owner') ? old('business_owner') : $document->business_permit->business_owner ?? '' }}"
                        placeholder="Business Owner">

                    @error('business_owner')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div
                    class="col-12 col-sm-6 col-lg-4 position-relative business-permit-input @if (!old('bp')) d-none @endif">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('business_add') is-invalid @enderror grayed"
                        name="business_add"
                        value="{{ old('business_add') ? old('business_add') : $document->business_permit->business_add ?? '' }}"
                        placeholder="Business Address">

                    @error('business_add')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div
                    class="col-12 col-sm-6 col-lg-5 position-relative business-permit-input @if (!old('bp')) d-none @endif">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('business_nature') is-invalid @enderror grayed"
                        name="business_nature"
                        value="{{ old('business_nature') ? old('business_nature') : $document->business_permit->business_nature ?? '' }}"
                        placeholder="Business Nature">

                    @error('business_nature')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-lg-9 position-relative">
                    <div class="multiselect-wrapper">
                        <div class="position-relative select-list">
                            <div class="title title-request-purpose">Purpose of Request</div>
                            <div class="select-options">
                                <div class="option">
                                    <input type="checkbox" name="sch" id="scholarship" value="Scholarship"
                                        data-purpose="Scholarship" class="request-purpose"
                                        @if (old('sch')) checked @endif />
                                    <label for="scholarship">Scholarship</label>
                                </div>
                                <div class="option">
                                    <input type="checkbox" name="pas" id="passport" value="Passport Application"
                                        data-purpose="Passport Application" class="request-purpose"
                                        @if (old('pas')) checked @endif />
                                    <label for="passport">Passport Application</label>
                                </div>
                                <div class="option">
                                    <input type="checkbox" name="gov" id="government" value="For Government Purposes"
                                        data-purpose="For Government Purposes" class="request-purpose"
                                        @if (old('gov')) checked @endif />
                                    <label for="government">For Government Purposes</label>
                                </div>
                                <div class="option">
                                    <input type="checkbox" name="lto" id="business"
                                        value="License to Operate (For Business Permits Only)"
                                        data-purpose="License to Operate (For Business Permits Only)"
                                        class="request-purpose" @if (old('lto')) checked @endif />
                                    <label for="business" id="label-business"
                                        style="cursor: disabled; pointer-events: none;">License to Operate (For Business
                                        Permits Only)</label>
                                </div>
                                <div class="option">
                                    <input type="checkbox" name="oth" id="others" data-purpose="Others (Please specify)"
                                        class="request-purpose" @if (old('oth')) checked @endif />
                                    <label for="others">Others (Please specify)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (\Session::has('require_purpose'))
                        <div class="position-relative">
                            <div class="custom-dropdown-error"
                                style="position: absolute; top: 2px; background: #DE4856; border-radius: 5px; padding: 5px; color: white; font-size: 13px; z-index: 666;">
                                {!! \Session::get('require_purpose') !!}
                            </div>
                        </div>
                    @endif
                </div>

                <div
                    class="col-12 col-lg-9 position-relative specify-others-input @if (!old('oth')) d-none @endif">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('purpose') is-invalid @enderror grayed"
                        name="purpose" id="purpose" value="{{ old('purpose') }}" placeholder="Specify purpose">

                    @error('purpose')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-6 pt-5">
                            <div class="row">
                                <div class="col-12 col-md-3 col-lg-4">
                                    {{-- <a href="{{ route('current_resident.requests.show', $latestRequest) }}" class="w-100 btn btn-primary form-btn btn-cancel main-cta">Cancel</a> --}}

                                    <input type="submit" class="w-100 btn btn-primary form-btn btn-next border-0 main-cta"
                                        value=" Back " form="requests.destroy">
                                </div>
                                <div class="col-12 col-md-3 mt-2 mt-md-0 col-lg-4 ">
                                    <input type="submit" class="w-100 btn btn-primary form-btn btn-next border-0 main-cta"
                                        value=" Next ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="request-img">
                <img src="{{ url('images/request-create.png') }}" alt="photo" class="" style="">
            </div>

            <footer class="footer" id="footer" style="">
                <div class="">
                    <p>Copyright © 2021 Barangay 899. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </section>
    @if (\Session::has('error'))
        <x-modal id="{{ \Session::get('modal') ?? 'N/A' }}">
            <x-slot name="title">
                {{ \Session::get('error')['title'] ?? 'N/A' }}
            </x-slot>

            <x-slot name="message">
                {!! \Session::get('error')['message'] ?? 'N/A' !!}
            </x-slot>

            {!! \Session::get('error')['link'] ?? '<button type="button" class="btn btn-primary px-4 form-btn btn-next border-0 main-cta"
            data-bs-dismiss="modal">Close</button>' !!}
        </x-modal>
    @endif
@endsection

@push('scripts')
    <script src="{{ url('js/prevent-back.js') }}" defer></script>

    <script src="{{ url('js/custom-dropdown.js') }}" defer></script>

    @if (\Session::has('modal'))
        <script defer>
            var id = "{{ Session::get('modal') }}";

            $(document).ready(function() {
                $('#' + id).modal('show');
            });
        </script>
    @endif
@endpush
