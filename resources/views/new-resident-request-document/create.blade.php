@extends('main.index')

@section('nav-bar')
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
                <h2 class="text-center"><b>Personal Information</b></h2>
                <p class="text-left">Please fill out all the necessary fields.</p>
                <p class="text-left"><b>Personal Background</b></p>
            </div>

            <form id="requests.store" action="{{ route('new_resident.requests.store') }}" method="POST"
                class="row g-4 px-0 px-lg-5">
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
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('suffix') is-invalid @enderror grayed"
                        name="suffix" placeholder="Suffix(Optional)" value="{{ old('suffix') }}">

                    @error('suffix')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('alias') is-invalid @enderror grayed"
                        name="alias" placeholder="Nickname(Optional)" value="{{ old('alias') }}">

                    @error('alias')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="text"
                        class="form-control border border-secondary @error('birth_date') is-invalid @enderror grayed"
                        name="birth_date" placeholder="Birthdate" onfocus="(this.type='date')"
                        value="{{ old('birth_date') }}" id="birthdate" required>

                    @error('birth_date')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <input type="number" min="0" class="form-control border border-secondary grayed" name="age"
                        placeholder="Age" value="{{ old('age') }}" id="age" readonly title="Age">
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('place_of_birth') is-invalid @enderror grayed"
                        name="place_of_birth" placeholder="Birthplace" value="{{ old('place_of_birth') }}" required>

                    @error('place_of_birth')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <select
                        class="form-select border border-secondary default-select @error('sex') is-invalid @enderror grayed"
                        name="sex" value="{{ old('sex') }}" required style="border-radius: 10px">
                        <option value="" disabled selected>Sex</option>
                        <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>

                    @error('sex')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('citizenship') is-invalid @enderror grayed"
                        name="citizenship" placeholder="Citizenship" value="{{ old('citizenship') }}" required>

                    @error('citizenship')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <select
                        class="form-select border border-secondary default-select @error('civil_status') is-invalid @enderror grayed"
                        name="civil_status" value="{{ old('civil_status') }}" required style="border-radius: 10px">
                        <option value="" disabled selected>Civil Status</option>
                        <option value="single" {{ old('civil_status') == 'single' ? 'selected' : '' }}>Single</option>
                        <option value="married" {{ old('civil_status') == 'married' ? 'selected' : '' }}>Married</option>
                        <option value="Widowed" {{ old('civil_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                        <option value="Divorced" {{ old('civil_status') == 'Divorced' ? 'selected' : '' }}>Divorced
                        </option>
                    </select>

                    @error('civil_status')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('religion') is-invalid @enderror grayed"
                        name="religion" placeholder="Religion" value="{{ old('religion') }}" required>

                    @error('religion')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('blood_type') is-invalid @enderror grayed"
                        name="blood_type" placeholder="Blood Type" value="{{ old('blood_type') }}" required>

                    @error('blood_type')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <select
                        class="form-select border border-secondary default-select @error('pwd') is-invalid @enderror grayed"
                        name="pwd" value="{{ old('pwd') }}" required style="border-radius: 10px">
                        <option value="" disabled selected>PWD?</option>
                        <option value="yes" {{ old('pwd') == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="no" {{ old('pwd') == 'no' ? 'selected' : '' }}>No</option>
                    </select>

                    @error('pwd')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="number" min="1"
                        class="form-control border border-secondary @error('years_of_residence') is-invalid @enderror grayed"
                        name="years_of_residence" placeholder="Years of Residency"
                        value="{{ old('years_of_residence') }}" required>

                    @error('years_of_residence')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <select
                        class="form-select border border-secondary default-select @error('member_4ps') is-invalid @enderror grayed"
                        name="member_4ps" value="{{ old('member_4ps') }}" required style="border-radius: 10px">
                        <option value="" disabled selected>4Ps Member?</option>
                        <option value="yes" {{ old('member_4ps') == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="no" {{ old('member_4ps') == 'no' ? 'selected' : '' }}>No</option>
                    </select>

                    @error('member_4ps')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <select
                        class="form-select border border-secondary default-select @error('voter_status') is-invalid @enderror grayed"
                        name="voter_status" value="{{ old('voter_status') }}" required style="border-radius: 10px">
                        <option value="" disabled selected>Voter's Status</option>
                        <option value="Voter" {{ old('voter_status') == 'Voter' ? 'selected' : '' }}>Voter</option>
                        <option value="Non-voter" {{ old('voter_status') == 'Non-voter' ? 'selected' : '' }}>Non-voter
                        </option>
                    </select>

                    @error('voter_status')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <select
                        class="form-select border border-secondary default-select @error('identified_as') is-invalid @enderror grayed"
                        name="identified_as" value="{{ old('identified_as') }}" required style="border-radius: 10px">
                        <option value="" disabled selected>Identified as</option>
                        <option value="Positive" {{ old('identified_as') == 'Positive' ? 'selected' : '' }}>Positive
                        </option>
                        <option value="Negative" {{ old('identified_as') == 'Negative' ? 'selected' : '' }}>Negative
                        </option>
                    </select>

                    @error('identified_as')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="email" title="Example: sample@gmail.com"
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
                        class="form-control border border-secondary @error('floor_no') is-invalid @enderror grayed"
                        name="floor_no" placeholder="Floor Number (Optional)" value="{{ old('floor_no') }}">

                    @error('floor_no')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('block_no') is-invalid @enderror grayed"
                        name="block_no" placeholder="Block Number (Optional)" value="{{ old('block_no') }}">

                    @error('block_no')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('street_name') is-invalid @enderror grayed"
                        name="street_name" placeholder="Street Name" value="{{ old('street_name') }}" required>

                    @error('street_name')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('family_relation') is-invalid @enderror grayed"
                        name="family_relation" placeholder="Relation to the Head of Family"
                        value="{{ old('family_relation') }}" required>

                    @error('family_relation')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <b>Employment Background</b>
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <select
                        class="form-select border border-secondary default-select @error('emp_stat') is-invalid @enderror grayed"
                        name="emp_stat" value="{{ old('emp_stat') }}" required style="border-radius: 10px">
                        <option value="" disabled selected>Employment Status</option>
                        <option value="Working" {{ old('emp_stat') == 'Working' ? 'selected' : '' }}>Working</option>
                        <option value="Non-working" {{ old('emp_stat') == 'Non-working' ? 'selected' : '' }}>Non-working
                        </option>
                    </select>

                    @error('emp_stat')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('occupation') is-invalid @enderror grayed"
                        name="occupation" placeholder="Occupation (Optional)" value="{{ old('occupation') }}">

                    @error('occupation')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('emp_name') is-invalid @enderror grayed"
                        name="emp_name" placeholder="Employer's Name (Optional)" value="{{ old('emp_name') }}">

                    @error('emp_name')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="number"
                        class="form-control border border-secondary @error('monthly_income') is-invalid @enderror grayed"
                        name="monthly_income" placeholder="Monthly Income" value="{{ old('monthly_income') }}" required>

                    @error('monthly_income')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <b>Other Details</b>
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('sss_no') is-invalid @enderror grayed"
                        name="sss_no" placeholder="SSS No. (Optional)" value="{{ old('sss_no') }}">

                    @error('sss_no')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('tin_no') is-invalid @enderror grayed"
                        name="tin_no" placeholder="TIN No. (Optional)" value="{{ old('tin_no') }}">

                    @error('tin_no')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('gsis_no') is-invalid @enderror grayed"
                        name="gsis_no" placeholder="GSIS No. (Optional)" value="{{ old('gsis_no') }}">

                    @error('gsis_no')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary @error('pagibig_no') is-invalid @enderror grayed"
                        name="pagibig_no" placeholder="PAGIBIG No. (Optional)" value="{{ old('pagibig_no') }}">

                    @error('pagibig_no')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 col-lg-3 position-relative">
                    <input type="search" autocomplete="off"
                        class="form-control border border-secondary grayed @error('philhealth_no') is-invalid @enderror"
                        name="philhealth_no" placeholder="PhilHealth No. (Optional)" value="{{ old('philhealth_no') }}">

                    @error('philhealth_no')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>
            </form>

            <div class="row px-0 px-lg-5 mt-5">
                <h2 class="text-center"><b>Request Documents</b></h2>
            </div>

            <div class="row g-4 px-0 px-lg-5">
                <div class="col-12 col-md-9 position-relative">
                    <input type="search" autocomplete="off" form="requests.store"
                        class="form-control border border-secondary grayed @error('name_of_witness') is-invalid @enderror"
                        name="name_of_witness" placeholder="Name of witness of residency"
                        value="{{ old('name_of_witness') }}" required>

                    @error('name_of_witness')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-lg-9 position-relative">
                    <div class="multiselect-wrapper">
                        <div class="position-relative select-list">
                            <div class="title title-barangay-documents">Select any barangay document you want to request
                            </div>
                            <div class="select-options">
                                <div class="option">
                                    <input form="requests.store" type="checkbox" name="cor" id="cor" value="r"
                                        data-document="Certificate of Residency" class="barangay-document"
                                        @if (old('cor')) checked @endif />
                                    <label for="cor">Certificate of Residency</label>
                                </div>
                                <div class="option">
                                    <input form="requests.store" type="checkbox" name="coi" id="coi" value="i"
                                        data-document="Certificate of Indigency" class="barangay-document"
                                        @if (old('coi')) checked @endif />
                                    <label for="coi">Certificate of Indigency</label>
                                </div>
                                <div class="option">
                                    <input form="requests.store" type="checkbox" name="bc" id="bc" value="c"
                                        data-document="Barangay Certification" class="barangay-document"
                                        @if (old('bc')) checked @endif />
                                    <label for="bc">Barangay Certification</label>
                                </div>
                                <div class="option">
                                    <input form="requests.store" type="checkbox" name="bp" id="bp" value="b" <input
                                        type="checkbox" name="bp" id="bp" value="b" data-document="Business Permit"
                                        class="barangay-document" @if (old('bp')) checked @endif />
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
                    <input type="search" autocomplete="off" form="requests.store"
                        class="form-control border border-secondary grayed @error('business_name') is-invalid @enderror"
                        name="business_name" value="{{ old('business_name') }}" placeholder="Business Name">

                    @error('business_name')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div
                    class="col-12 col-sm-6 col-lg-5 position-relative business-permit-input @if (!old('bp')) d-none @endif">
                    <input type="search" autocomplete="off" form="requests.store"
                        class="form-control border border-secondary grayed  @error('business_owner') is-invalid @enderror"
                        name="business_owner" value="{{ old('business_owner') }}" placeholder="Business Owner">

                    @error('business_owner')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div
                    class="col-12 col-sm-6 col-lg-4 position-relative business-permit-input @if (!old('bp')) d-none @endif">
                    <input type="search" autocomplete="off" form="requests.store"
                        class="form-control border border-secondary grayed  @error('business_add') is-invalid @enderror"
                        name="business_add" value="{{ old('business_add') }}" placeholder="Business Address">

                    @error('business_add')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div
                    class="col-12 col-sm-6 col-lg-5 position-relative business-permit-input @if (!old('bp')) d-none @endif">
                    <input type="search" autocomplete="off" form="requests.store"
                        class="form-control border border-secondary grayed  @error('business_nature') is-invalid @enderror"
                        name="business_nature" value="{{ old('business_nature') }}" placeholder="Business Nature">

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
                                    <input form="requests.store" type="checkbox" name="sch" id="scholarship"
                                        value="Scholarship" data-purpose="Scholarship" class="request-purpose"
                                        @if (old('sch')) checked @endif />
                                    <label for="scholarship">Scholarship</label>
                                </div>
                                <div class="option">
                                    <input form="requests.store" type="checkbox" name="pas" id="passport"
                                        value="Passport Application" data-purpose="Passport Application"
                                        class="request-purpose" @if (old('pas')) checked @endif />
                                    <label for="passport">Passport Application</label>
                                </div>
                                <div class="option">
                                    <input form="requests.store" type="checkbox" name="gov" id="government"
                                        value="For Government Purposes" data-purpose="For Government Purposes"
                                        class="request-purpose" @if (old('gov')) checked @endif />
                                    <label for="government">For Government Purposes</label>
                                </div>
                                <div class="option">
                                    <input form="requests.store" type="checkbox" name="oth" id="others"
                                        data-purpose="Others (Please specify)" class="request-purpose"
                                        @if (old('oth')) checked @endif />
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
                    <input type="search" autocomplete="off" form="requests.store"
                        class="form-control border border-secondary grayed @error('purpose') is-invalid @enderror"
                        name="purpose" value="{{ old('purpose') }}" placeholder="Specify purpose">

                    @error('purpose')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <div class="row position-relative"">
                        <div class="   col-12 col-lg-6 pt-5">
                            <div class=" row">
                                <div class="col-12 col-md-3 col-lg-4">
                                    <a href="{{ route('home') }}" class="w-100 btn btn-primary form-btn btn-cancel">Cancel</a>
                                </div>
                                <div class="col-12 col-md-3 mt-2 mt-md-0 col-lg-4 ">
                                    <input type="submit" class="w-100 btn btn-primary form-btn btn-next border-0" value=" Next "
                                        form="requests.store">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 position-relative">
                            <img src="{{ url('images/request-create.png') }}" alt="photo" class="request-img" style="">
                        </div>
                        <footer class="footer" id="footer">
                            <div class="">
                                <p>Copyright © 2021 Barangay 899. All rights reserved.</p>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
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

            <button type="button" class="btn btn-primary px-4 form-btn btn-next border-0"
                data-bs-dismiss="modal">Close</button>
        </x-modal>
    @endif
@endsection

@push('scripts')
    {{-- prevent returning to prev page --}}
    <script defer>
        function preventBack() {
            window.history.forward();
        }
        window.onunload = function() {
            null;
        };
        setTimeout("preventBack()", 0);
    </script>

    {{-- change inputs background color --}}
    <script defer>
        var selects = document.querySelectorAll('select');

        selects.forEach(element => {
            if (element.value !== '') element.style.background = "#E9E9E9";
        });

        $('select').on('change', function(e) {
            if (this.value !== '') $(this).css("background", "#E9E9E9");
        });
    </script>

    {{-- auto calculate age based on birthdate --}}
    <script defer>
        const handler = {
            calculateAge: function(date_of_birth) {
                var today = new Date();
                var birthDate = new Date(date_of_birth);
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();

                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;

                return age;
            },

            populateAge: function() {
                let birthdate = $('#birthdate').val();
                let age = handler.calculateAge(birthdate);

                localStorage['age'] = age;
                $('#age').val(age);
            }
        }

        $(document).ready(function() {
            if (!Date.parse($("#birthdate").val())) localStorage['age'] = '';

            if (localStorage['age'] !== '') $('#age').val(localStorage['age']);
        });

        // onchange="calculateAge()" 
        $("#birthdate").on("change", handler.populateAge);
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
