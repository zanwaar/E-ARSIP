<div class="container-xxl flex-grow-1">
    <div class="bg-white my-3 rounded">
        <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row px-4 py-2 ">
            <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Dokument /</span> Surat Masuk</h4>
            <div class="">
                <!-- <a href="" class="btn btn-primary">Tambah</a> -->
                <!-- Button trigger modal -->
                <div class="input-group input-group-merge">
                    <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31" />
                </div>
            </div>
        </div>
    </div>

    <div class="card my-3">

        <div class="d-flex justify-content-end p-2">
            <div class="btn-group" role="group" aria-label="Second group">
                <button wire:click.prevent="add()" type="button" class="btn btn-outline-secondary">
                    <i class="bx bx-folder-plus"></i>
                    <span style="font-size: 13px;"> Tambah Surat Masuk</span>
                </button>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nomor Surat</th>
                        <th>Pengirim</th>
                        <th>Tanggal Masuk</th>
                        <th>Perihal</th>
                        <th>Disposisi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suratMasuks as $suratMasuk)
                    <tr>
                        <td>{{ $suratMasuk->nomor_surat }}</td>
                        <td>{{ $suratMasuk->pengirim }}</td>
                        <td>{{ $suratMasuk->tanggal_masuk }}</td>
                        <td>{{ $suratMasuk->perihal }}</td>
                        <td>
                            <a href="{{url('dokument/' .$suratMasuk->id .'/disposisi')}}"><i class='menu-icon tf-icons bx bx-briefcase-alt-2'></i>Info Detail</a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $suratMasuks->links('vendor.pagination.bootstrap-5') }}
    

    <!-- Modal Tambah Surat Masuk -->
    <div class="modal fade" id="add" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nomor_surat" class="form-label">Nomor Surat</label>
                            <input type="text" id="nomor_surat" class="form-control" readonly value="{{$nomorSurat}}" />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="pengirim" class="form-label">Pengirim</label>
                            <input type="text" id="pengirim" wire:model="pengirim" class="form-control @error('pengirim') is-invalid @enderror" placeholder="Masukan Nama" />
                            @error('pengirim')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col mb-0">
                            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                            <input type="date" id="tanggal_masuk" wire:model="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" placeholder="DD / MM / YY" />
                            @error('tanggal_masuk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nomor_surat" class="form-label">Perihal</label>
                            <textarea class="form-control" wire:model="perihal" name="" id=""></textarea>
                        </div>
                    </div>
                    <!-- FILE DOKUMENT SURAT -->
                    <livewire:dropzone wire:model="files" :rules="['mimes:pdf']" :multiple="true" :key="'dropzone-two'" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" wire:click="saves" class="btn btn-primary">Save changes</button>
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