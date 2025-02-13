@if (session('success'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 99999;">
        <div class="bs-toast toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="ti ti-check ti-xs me-2 text-success"></i>
                <div class="me-auto fw-medium">Sip, Berhasil</div>
                <i class="ti ti-x ti-xs text-white bg-danger p-1" data-bs-dismiss="toast" aria-label="Close"
                    style="border-radius: 5px;"></i>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 99999;">
        <div class="bs-toast toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="ti ti-x ti-xs me-2 text-danger"></i>
                <div class="me-auto fw-medium">Yah, Gagal</div>
                <i class="ti ti-x ti-xs text-white bg-danger p-1" data-bs-dismiss="toast" aria-label="Close"
                    style="border-radius: 5px;"></i>
            </div>
            <div class="toast-body">
                {{ session('error') }}
            </div>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 99999;">
        <div class="bs-toast toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="ti ti-check ti-xs me-2 text-danger"></i>
                <div class="me-auto fw-medium">Terjadi Kesalahan</div>
                <i class="ti ti-x ti-xs text-white bg-danger p-1" data-bs-dismiss="toast" aria-label="Close"
                    style="border-radius: 5px;"></i>
            </div>
            <div class="toast-body">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
