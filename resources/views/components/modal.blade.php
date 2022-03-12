<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white rounded" style="background: #0C7087;">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ $title ?? 'N/A' }}
                </h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                {{ $message ?? 'N/A' }}
            </div>
            <div class="modal-footer" style="border-top: 1px solid #0C7087;">
                {{  $slot ?? '' }}
            </div>
        </div>
    </div>
</div>
