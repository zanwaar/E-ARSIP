<div class="container-xxl flex-grow-1">
    <div class="mt-4 rounded">
        <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row ">
            <h4 class="fw-bold "><span class="text-muted fw-light">Profile /</span> Informasi Profile</h4>
            <div class="">
                <!-- <a href="" class="btn btn-primary">Tambah</a> -->
                <!-- Button trigger modal -->

            </div>
        </div>
    </div>

    <div class="rounded bg-white ">
        <div class="row ">
            <div class="col-md-12">
                <div class=" mb-3">
                    <div class="row g-0">
                        <div class="col-md-3">
                            <div class="card-body position-relative">
                                <img src="{{$modelUser->avatar_url}}" a alt="Profile" class="card-img card-img-left">
                                <button wire:click="add()" type="button" style="right: 20px; top: 10px" class="position-absolute btn rounded-pill btn-icon btn-warning">
                                    <span class="tf-icons  bx bx-edit-alt"></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-7 col-lg-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" id="name" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama" />
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">E-mail</label>
                                            <input placeholder="john.doe@example.com" type="text" id="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukan Nama" />
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="notlpn" class="form-label">No Tlpn</label>
                                            <input placeholder="202 555 0111" type="text" id="notlpn" wire:model="notlpn" class="form-control @error('notlpn') is-invalid @enderror" placeholder="Masukan Nama" />
                                            @error('notlpn')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button wire:click="update" class="btn btn-primary me-2">Perbarui</button>
                                        <button type="reset" class="btn btn-outline-secondary">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">FOTO PROFILE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col mb-2">
                        <livewire:dropzone wire:model="image" :rules="['image','mimes:png,jpeg','max:10420']" :key="'dropzone-two'" />
                    </div>
                    <!-- FILE DOKUMENT SURAT -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" wire:click="update_profile" class="btn btn-primary">Save changes</button>

                </div>
            </div>
        </div>
    </div>

</div>
@push('scripts')
<script>
    var modal = new bootstrap.Modal(document.getElementById('add'), {
        backdrop: 'static',
        keyboard: false
    });
    window.addEventListener("hide-form", function(event) {
        $("#add").modal("hide");
    });
    window.addEventListener("show-modal-add", function(event) {
        $("#add").modal("show");
    });
</script>
@endpush