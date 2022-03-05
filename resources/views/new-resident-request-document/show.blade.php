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
                <h2 class="text-center"><b>Confirmation</b></h2>
                <p class="text-left">Summary of Request</p>
            </div>

            <form id="requests.destroy" action="{{ route('new_resident.requests.destroy', $modelsRequest->resident_id) }}"
                method="POST">
                @method('DELETE')
                @csrf
            </form>

            <form id="requests.confirm" action="{{ route('requests.confirm', $modelsRequest) }}" method="POST"
                class="row g-4 px-0 px-lg-5">
                @csrf
                <div class="col-12 col-md-6 ps-lg-5">
                    <label class=""><b>Fullname</b></label>
                    <p class="">{{ $modelsRequest->fullName ?? 'N/A' }}</p>
                </div>

                <div class="col-12 col-md-6">
                    <label><b>Address</b></label>
                    <p>{{ $modelsRequest->address ?? 'N/A' }}</p>
                </div>

                <div class="col-12 col-md-6 ps-lg-5">
                    <label><b>Email Address</b></label>
                    <p>{{ $modelsRequest->email_add ?? 'N/A' }}</p>
                </div>

                <div class="col-12 col-md-6">
                    <label><b>Contact Number</b></label>
                    <p>{{ $modelsRequest->contact_number_formatted ?? 'N/A' }}</p>
                </div>

                <div class="col-12 col-md-6 ps-lg-5">
                    <label><b>Barangay Documents</b></label>
                    <ul>
                        @foreach ($modelsRequest->documents as $document)
                            <li>
                                <p>{{ $document->name ?? 'N/A' }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-12 col-md-6">
                    <label><b>Purpose</b></label>
                    <p>
                        @foreach ($modelsRequest->purposes as $document)
                            {{ $loop->first ? '' : ', ' }}
                            <span>{{ $document ?? 'N/A' }}</span>
                        @endforeach
                    </p>
                </div>

                <div class="col-12">
                    <div class="row position-relative">
                        <div class="col-12 col-xl-9 col-xxl-10 d-flex flex-row align-items-start">
                            <input class="m-2" type="checkbox" name="certify" id="certify" />
                            <label class="" for="certify" class="">I hereby certify that the
                                above information given
                                are true
                                and correct. And I consent Barangay 899
                                <br class="d-none d-xl-block">under the standards of Data Proctection and Privacy Act to
                                collect and process the given
                                information.</label>
                        </div>

                        <div class="col-12 col-lg-6 pt-5">
                            <div class="row">
                                <div class="col-12 col-md-3 col-lg-4">
                                    <input type="submit" class="w-100 btn btn-primary form-btn btn-next" value=" Back "
                                        form="requests.destroy">
                                </div>
                                <div class="col-12 col-md-3 mt-2 mt-md-0 col-lg-4 ">
                                    <input type="submit" class="w-100 btn btn-primary form-btn btn-next" value="Okay"
                                    form="requests.confirm">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 position-relative text-center text-lg-end">
                            <img src="{{ url('images/request-confirm.png') }}" alt="photo"
                                class="position-relative confirm-img mt-5" style="">
                        </div>
                        <footer class="footer" id="footer" style="top: 200px;">
                            <div class="">
                                <p>Copyright © 2021 Barangay 899. All rights reserved.</p>
                            </div>
                        </footer>
                    </div>
                </div>
            </form>

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
                    <button type="button" class="btn btn-primary form-btn btn-next" data-bs-toggle="modal"
                        data-bs-target="#confirmModal">
                        Okay
                    </button>
                @endif
            </x-modal>
        </div>
    </section>
@endsection

@push('scripts')
    @error('certify')
        <script defer>
            $(document).ready(function() {
                $('#confirmModal').modal('show');
            });
        </script>
    @enderror
@endpush