@extends('main.index')

@section('nav-bar')
    {{-- anonymous component: views -> components -> header blade --}}
    <x-header>
        <li class="nav-item">
            <a class="nav-link ms-4" href="{{ route('home') }}">Home</a>
        </li>
    </x-header>
@endsection

@section('content')
    <section class="mt-5 py-5">
        <div class="container px-3 px-md-5">
            <div class="row px-0 px-lg-5">
                <h2 class="text-center"><b>Request Documents</b></h2>
                <p class="text-left">Please fill out all the necessary fields.</p>
            </div>

            <form action="{{ route('current_resident.requests.store') }}" method="POST" class="row g-4 px-0 px-lg-5">
                @csrf
                <div style="display: none;">
                    <input type="text" id="PreventChromeAutocomplete" name="PreventChromeAutocomplete"
                        autocomplete="address-level4" />
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('last_name') is-invalid @enderror grayed"
                        name="last_name" placeholder="Lastname" value="{{ old('last_name') }}" required>

                    @error('last_name')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('first_name') is-invalid @enderror grayed"
                        name="first_name" placeholder="Firstname" value="{{ old('first_name') }}" required>

                    @error('first_name')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('middle_name') is-invalid @enderror grayed"
                        name="middle_name" placeholder="Middlename" value="{{ old('middle_name') }}" required>

                    @error('middle_name')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off" class="form-control border border-secondary grayed"
                        name="suffix" placeholder="Suffix(Optional)" value="{{ old('suffix') }}">
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('house_number') is-invalid @enderror grayed"
                        name="house_number" placeholder="House Number" value="{{ old('house_number') }}" required>

                    @error('house_number')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('street') is-invalid @enderror grayed"
                        name="street" placeholder="Street" value="{{ old('street') }}" required>

                    @error('street')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="email" autocomplete="off" title="Example: sample@gmail.com"
                        pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$"
                        class="form-control border border-secondary @error('email_add') is-invalid @enderror grayed"
                        name="email_add" placeholder="Email Address" value="{{ old('email_add') }}" required>
                    @error('email_add')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="text"
                        class="form-control border border-secondary @error('contact_number') is-invalid @enderror grayed"
                        name="contact_number" placeholder="Contact Number" value="{{ old('contact_number') }}" required>

                    @error('contact_number')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-lg-9 position-relative">
                    <div class="multiselect-wrapper">
                        <div class="select-list">
                            <div class="title title-barangay-documents">Select any barangay document you want to request
                            </div>
                            <div class="select-options">
                                <div class="option">
                                    <input type="checkbox" name="cor" id="cor" value="r"
                                        data-document="Certificate of Residency" class="barangay-document"
                                        @if (old('cor')) checked @endif />
                                    <label for="cor">Certificate of Residency</label>
                                </div>
                                <div class="option">
                                    <input type="checkbox" name="coi" id="coi" value="i"
                                        data-document="Certificate of Indigency" class="barangay-document"
                                        @if (old('coi')) checked @endif />
                                    <label for="coi">Certificate of Indigency</label>
                                </div>
                                <div class="option">
                                    <input type="checkbox" name="bc" id="bc" value="c"
                                        data-document="Barangay Certification" class="barangay-document"
                                        @if (old('bc')) checked @endif />
                                    <label for="bc">Barangay Certification</label>
                                </div>
                                <div class="option">
                                    <input type="checkbox" name="bp" id="bp" value="b" data-document="Business Permit"
                                        class="barangay-document business-permit"
                                        @if (old('bp')) checked @endif />
                                    <label for="bp">Business Permit</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (\Session::has('require_document'))
                        <div class="custom-dropdown-error"
                            style="position: absolute; top: 41px; background: #DE4856; border-radius: 5px; padding: 5px; color: white; font-size: 13px; z-index: 666;">
                            {!! \Session::get('require_document') !!}
                        </div>
                    @endif
                </div>

                <div class="col-0 col-md-12 col-lg-3 empty-col" style="">&nbsp;</div>

                <div
                    class="col-12 col-sm-6 col-lg-4 position-relative business-permit-input @if (!old('bp')) d-none @endif">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('business_name') is-invalid @enderror grayed"
                        name="business_name" value="{{ old('business_name') }}" placeholder="Business Name">

                    @error('business_name')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div
                    class="col-12 col-sm-6 col-lg-5 position-relative business-permit-input @if (!old('bp')) d-none @endif">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('business_owner') is-invalid @enderror grayed"
                        name="business_owner" value="{{ old('business_owner') }}" placeholder="Business Owner">

                    @error('business_owner')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div
                    class="col-12 col-sm-6 col-lg-4 position-relative business-permit-input @if (!old('bp')) d-none @endif">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('business_add') is-invalid @enderror grayed"
                        name="business_add" value="{{ old('business_add') }}" placeholder="Business Address">

                    @error('business_add')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div
                    class="col-12 col-sm-6 col-lg-5 position-relative business-permit-input @if (!old('bp')) d-none @endif">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('business_nature') is-invalid @enderror grayed"
                        name="business_nature" value="{{ old('business_nature') }}" placeholder="Business Nature">

                    @error('business_nature')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-lg-9 position-relative">
                    <div class="multiselect-wrapper">
                        <div class="select-list">
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
                                    <input type="checkbox" name="oth" id="others" data-purpose="Others (Please specify)"
                                        class="request-purpose" @if (old('oth')) checked @endif />
                                    <label for="others">Others (Please specify)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (\Session::has('require_purpose'))
                        <div class="custom-dropdown-error"
                            style="position: absolute; top: 41px; background: #DE4856; border-radius: 5px; padding: 5px; color: white; font-size: 13px; z-index: 666;">
                            {!! \Session::get('require_purpose') !!}
                        </div>
                    @endif
                </div>

                <div class="col-0 col-md-12 col-lg-3 empty-col" style="">&nbsp;</div>

                <div
                    class="col-12 col-lg-9 position-relative specify-others-input @if (!old('oth')) d-none @endif">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('purpose') is-invalid @enderror grayed"
                        name="purpose" value="{{ old('purpose') }}" placeholder="Specify purpose">

                    @error('purpose')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <div class="row position-relative">
                        <div class="col-12 col-lg-6 pt-5">
                            <div class="row">
                                <div class="col-12 col-md-3 col-lg-4">
                                    <a href="#" class="w-100 btn btn-primary form-btn btn-cancel">Cancel</a>
                                </div>
                                <div class="col-12 col-md-3 mt-2 mt-md-0 col-lg-4 ">
                                    <input type="submit" class="w-100 btn btn-primary form-btn btn-next" value=" Next ">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 position-relative">
                            <img src="{{ url('images/request-create.png') }}" alt="photo"
                                class="position-relative  request-img" style="">
                        </div>
                        <footer class="footer" id="footer" style="">
                            <div class="">
                                <p>Copyright © 2021 Barangay 899. All rights reserved.</p>
                            </div>
                        </footer>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @if (\Session::has('Exception'))
        <x-modal>
            <x-slot name="title">
                {{ \Session::get('Exception')['title'] ?? 'N/A' }}
            </x-slot>

            <x-slot name="message">
                {{ \Session::get('Exception')['message'] ?? 'N/A' }}
            </x-slot>

            <button type="button" class="btn btn-primary px-4 form-btn btn-next" data-bs-dismiss="modal">Close</button>
        </x-modal>
    @endif
@endsection

{{-- push this script to @stack --}}
@push('scripts')
    <script defer>
        function preventBack() {
            window.history.forward();
        }
        window.onunload = function() {
            null;
        };
        setTimeout("preventBack()", 0);
    </script>

    <script src="{{ url('js/custom-dropdown.js') }}" defer></script>

    @if (\Session::has('showModal'))
        <script defer>
            $(document).ready(function() {
                $('#confirmModal').modal('show');
            });
        </script>
    @endif
@endpush
