@if(session('error'))
    <!-- Danger Alert -->
    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
        <i class="ri-error-warning-line label-icon"></i> {{session('error')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('success'))
    <!-- Success Alert -->
    <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
        <i class="ri-notification-off-line label-icon"></i> {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

@endif

@if ($errors->any())
    <!-- Danger Alert -->
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
