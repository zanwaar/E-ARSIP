<div class="container-xxl flex-grow-1">
    <div class=" mt-4 rounded">
        <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row ">
            <h4 class="fw-bold"><span class="text-muted fw-light">Pengguna /</span> List Pengguna</h4>
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
    <div class="card mb-3">
        <div class="d-flex p-3">
            <div class="me-3">
                <div class="input-group input-group-merge">
                    <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                    <input wire:model.live="searchTerm" type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31" />
                </div>
            </div>
            <div class="btn-group  " role="group" aria-label="Basic example">
                <button type="button" class="btn-sm {{$selectedJabatan == 'ALL' ? 'btn btn-primary' : 'btn btn-outline-primary'}}" wire:click="filterByJabatan('ALL')">ALL</button>
                <button type="button" class="btn-sm {{$selectedJabatan == 'KADIS' ? 'btn btn-primary' : 'btn btn-outline-primary'}}" wire:click="filterByJabatan('KADIS')">KADIS</button>
                <button type="button" class="btn-sm {{$selectedJabatan == 'SUBKABIB' ? 'btn btn-primary' : 'btn btn-outline-primary'}}" wire:click="filterByJabatan('SUBKABIB')">KABIB</button>
                <button type="button" class="btn-sm {{$selectedJabatan == 'KASI' ? 'btn btn-primary' : 'btn btn-outline-primary'}}" wire:click="filterByJabatan('KASI')">KASI</button>
                <button type="button" class="btn-sm {{$selectedJabatan == 'STAFFBAGIAN' ? 'btn btn-primary' : 'btn btn-outline-primary'}}" wire:click="filterByJabatan('STAFFBAGIAN')">STAFF</button>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>No Tlpn</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($users as $user)
                    <tr>
                        <td class="d-flex align-items-center ">
                            <img src="{{$user->avatar_url}}" alt class="w-px-40 h-auto rounded-circle me-2" />
                            <strong class="">{{$user->name}}</strong>
                        </td>
                        <td>{!! $user->jabatans ? '<span class="badge bg-label-'.$user->jabatans->status_badge .' me-1">' .$user->jabatans->alias .'</span> ' . $user->jabatans->bidang->name : '<span class="badge bg-label-danger me-1">N/A</span>' !!}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->notlpn}}</td>
                        <td>
                            @if ($user->jabatans?->alias != 'KADIS')
                            <a class="btn rounded-pill btn-icon btn-default" href="{{url('bidang/' .$user->jabatans?->bidang?->id.'/detail')}}"><i class='menu-icon tf-icons text-primary bx bx-briefcase-alt-2'></i></a>
                            @else
                            <button wire:click="add({{$user->id}})" type="button" class="btn rounded-pill btn-icon btn-default">
                                <span class="tf-icons text-primary bx bx-edit-alt"></span>
                            </button>
                            @endif

                        </td>


                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    {{ $users->links() }}
    <!-- Modal Tambah Surat Masuk -->
    <div class="modal fade" id="add" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">KEPALA DINAS</h5>
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
                    <button type="button" wire:click="update" class="btn btn-primary">Save changes</button>

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