<div class="container-xxl flex-grow-1">
    <div class="bg-white my-3 rounded">
        <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row px-4 py-2 ">
            <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Bidang / Detail /</span> {{$bidang->name}}</h4>
            <div class="">
                <!-- <a href="" class="btn btn-primary">Tambah</a> -->
                <!-- Button trigger modal -->
                <!-- <div class="input-group input-group-merge">
                    <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31" />
                </div> -->



            </div>
        </div>
    </div>
    <div class="container-xxl rounded   bg-white">

        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        @if ($bidang->kepalaBidang)
                        <img src="{{$bidang->kepalaBidang->user->avatar_url}}" alt="Profile" width="200px" height="200px" class="rounded-circle mb-3">

                        @else
                        <img src="{{url('storage/avatars/noimage.png')}}" alt="Profile" width="200px" height="200px" class="rounded-circle mb-3">

                        @endif
                        <h5 class="card-title">Kepala {{$bidang->name}}</h5>
                        <p class="card-text">
                            {!! $bidang->kepalaBidang
                            ? $bidang->kepalaBidang->user->name .
                            '<button wire:click="edit(' . $bidang->kepalaBidang->user->id . ')" type="button" class="btn rounded-pill btn-icon btn-default">
                                <span class="tf-icons text-primary bx bx-edit-alt"></span>
                            </button>'
                            : '<span class="badge bg-label-warning me-1">N/A</span>
                            <button wire:click="add(\'Kepala\')" type="button" class="btn rounded-pill btn-icon btn-default">
                                <span class="tf-icons text-primary bx bx-edit-alt"></span>
                            </button>'
                            !!}
                        </p>



                    </div>
                </div>

            </div>
            <div class="col-md-6">

                <div class="">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        @if ($bidang->kepalaSeksi)

                        <img src="{{$bidang->kepalaSeksi->user->avatar_url}}" alt="Profile" width="200px" height="200px" class="rounded-circle mb-3">
                        @else
                        <img src="{{url('storage/avatars/noimage.png')}}" alt="Profile" width="200px" height="200px" class="rounded-circle mb-3">

                        @endif
                        <h5 class="card-title">Kepala Seksi {{$bidang->name}}</h5>
                        <p class="card-text">
                            {!! $bidang->kepalaSeksi ? $bidang->kepalaSeksi->user->name .
                            '<button wire:click="edit(' . $bidang->kepalaSeksi->user->id . ')" type="button" class="btn rounded-pill btn-icon btn-default">
                                <span class="tf-icons text-primary bx bx-edit-alt"></span>
                            </button>'
                            : '<span class="badge bg-label-warning me-1">N/A</span>
                            <button wire:click="add(\'Kepala Seksi\')" type="button" class="btn rounded-pill btn-icon btn-default">
                                <span class="tf-icons text-primary bx bx-edit-alt"></span>
                            </button>'
                            !!}
                        </p>

                    </div>
                </div>

            </div>
        </div>

        <div class="divider">
            <div class="divider-text">
                <i class="bx bx-star"></i>
            </div>
        </div>
        <!-- Horizontal -->
        <div class="d-flex justify-content-between align-items-center h5">
            <div class="">
                Staff {{$bidang->name}}
            </div>
            <div class="btn-group" role="group" aria-label="Second group">
                <button wire:click="add('Staff')" type="button" class="btn btn-primary btn-sm">
                    <!-- <i class="bx bx-folder-plus"></i> -->
                    <span>Tambah Staff</span>
                </button>
            </div>
        </div>

        <div class="row mb-5">
            @foreach ($bidang->staff as $staff)
            <div class="col-md-6">
                <div class=" mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{$staff->user->avatar_url}}" a alt="Profile" class="card-img card-img-left">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"> {{$staff->user->name}} <span> <button wire:click="edit({{$staff->user->id}})" type="button" class="btn rounded-pill btn-icon btn-default">
                                            <span class="tf-icons text-primary bx bx-edit-alt"></span>
                                        </button></span></h5>
                                <p class="card-text">
                                    {{$staff->user->email}}
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach

        </div>
        <!--/ Horizontal -->
    </div>

    <div class="card">
        <h5 class="card-header">Hapus Bidang</h5>
        <div class="card-body">
            <div class="mb-3 col-12 mb-0">
                <div class="alert alert-warning">
                    <h6 class="alert-heading fw-bold mb-1">Apakah Anda yakin ingin menghapus bidang ini?</h6>
                    <p class="mb-0">Setelah Anda menghapus bidang ini, semua data terkait akan dihapus secara permanen dan tidak dapat dikembalikan. Mohon pastikan keputusan Anda.</p>
                </div>
            </div>
            <form id="formBidangDeletion" wire:submit.prevent="deleteBidang">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="confirmDeletion" id="confirmDeletion" wire:model="confirmDeletion" />
                    <label class="form-check-label" for="confirmDeletion">Saya mengonfirmasi penghapusan bidang ini</label>
                </div>
                <button type="submit" class="btn btn-danger">Hapus Bidang</button>
            </form>
        </div>
    </div>


    <!-- Modal Tambah Surat Masuk -->
    <div class="modal fade" id="add" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">{{$selectedJabatan}} {{$bidang->name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">

                        <div class="col mb-2">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama" />
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col mb-2">
                            <label for="email" class="form-label">E-mail</label>
                            <input placeholder="john.doe@example.com" type="text" id="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukan Nama" />
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col mb-2">
                        <label for="notlpn" class="form-label">No Tlpn</label>
                        <input placeholder="202 555 0111" type="text" id="notlpn" wire:model="notlpn" class="form-control @error('notlpn') is-invalid @enderror" placeholder="Masukan Nama" />
                        @error('notlpn')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col mb-2">
                        <label for="Password" class="form-label">Password</label>
                        <input type="text" id="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukan Password" />
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Foto</label>
                        <livewire:dropzone wire:model="image" :rules="['image','mimes:png,jpeg','max:10420']" :key="'dropzone-two'" />
                    </div>
                    <!-- FILE DOKUMENT SURAT -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    @if ($selectedJabatan == 'EDIT')
                    <button type="button" wire:click="update" class="btn btn-primary">Save changes</button>

                    @else
                    <button type="button" wire:click="saves" class="btn btn-dark">Save changes</button>

                    @endif
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