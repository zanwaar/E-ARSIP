<div class="container-xxl flex-grow-1">
    <div class="mt-4 rounded">
        <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row">
            <h4 class="fw-bold">
                <span class="text-muted fw-light">Profile /</span> Ubah Password
            </h4>
        </div>
    </div>
    <div class="card">
        <form wire:submit.prevent="updatePassword" class="card-body">
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input wire:model="current_password" id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" >
                @error('current_password') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="form-group mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input wire:model="new_password" id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" >
                @error('new_password') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="form-group mb-3">
                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                <input wire:model="new_password_confirmation" id="new_password_confirmation" type="password" class="form-control" >
            </div>
            <button type="submit" class="btn btn-primary">Update Password</button>
        </form>
    </div>
</div>