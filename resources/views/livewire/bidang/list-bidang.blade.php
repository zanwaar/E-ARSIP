<div class="container-xxl flex-grow-1">
    <div class="mt-4 rounded">
        <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row ">
            <h4 class="fw-bold "><span class="text-muted fw-light">Bidang /</span> List Bidang</h4>
            <div class="">
                <!-- <a href="" class="btn btn-primary">Tambah</a> -->
                <!-- Button trigger modal -->

            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="p-3 d-flex justify-content-between ">
            <div class="d-flex">
                <div class="me-3">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                        <input wire:model.live="searchTerm" type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31" />
                    </div>
                </div>
                <div class="btn-group" role="group" aria-label="Second group">
                    <button wire:click="add()" type="button" class="btn btn-primary btn-sm">
                        <i class="bx bx-folder-plus"></i>
                        <span style="font-size: 13px;"> Tambah Bidang</span>
                    </button>
                </div>

            </div>
            {{ $listBidang->links('vendor.pagination.simple-bootstrap-5') }}
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Bidang</th>
                        <th>Kepala Bidang</th>
                        <th>Kepala Seksi</th>
                        <th>Total Staff</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($listBidang as $bidang)
                    <tr>
                        <td> <strong>{{$bidang->name}}</strong> </td>
                        <td>{!! $bidang->kepalaBidang ? $bidang->kepalaBidang->user->name : '<span class="badge bg-label-danger me-1">N/A</span>' !!}</td>
                        <td>{!! $bidang->kepalaSeksi ? $bidang->kepalaSeksi->user->name : '<span class="badge bg-label-danger me-1">N/A</span>' !!}</td>
                        <td class="text-center ">{{ $bidang->total_staff }}</td>
                        <td>
                            <a wire:click="edit({{$bidang->id}})"> <i class="menu-icon tf-icons text-info bx bxs-edit dz-cursor-pointer"></i></a>
                            <a href="{{url('bidang/' .$bidang->id .'/detail')}}"><i class='menu-icon tf-icons bx bx-briefcase-alt-2'></i></a>


                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal Tambah Surat Masuk -->
    <div class="modal fade" id="add" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">{{$this->mbidang ? 'Edit Bidang' : 'Tambah Bidang'}}</h5>
                    <button type="button" wire:click="resets" class=" btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col mb-2">
                        <label for="name" class="form-label">Nama Bidang</label>
                        <input type="text" id="name" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama Bidang" />
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="resets" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" wire:click="saves" class="btn btn-dark">Save changes</button>

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