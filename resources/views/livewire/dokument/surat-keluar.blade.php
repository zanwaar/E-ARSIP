<div class="container-xxl flex-grow-1">
    <div class="mt-4 rounded">
        <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row ">
            <h4 class="fw-bold "><span class="text-muted fw-light">Dokument /</span> Surat Keluar</h4>
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
                        <!-- <i class="bx bx-folder-plus"></i> -->
                        <span style="font-size: 13px;">Tambah Surat Keluar</span>
                    </button>
                </div>

            </div>
            {{ $suratKeluars->links('vendor.pagination.simple-bootstrap-5') }}
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nomor Surat</th>
                        <th>Penerima</th>
                        <th>Tanggal Keluar</th>
                        <th>Perihal</th>
                        <th class="text-center">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suratKeluars as $suratKeluar)
                    <tr>
                        <td>{{ $suratKeluar->nomor_surat }}</td>
                        <td>{{ $suratKeluar->penerima }}</td>
                        <td>{{ $suratKeluar->tanggal_keluar }}</td>
                        <td>{{ $suratKeluar->perihal }}</td>
                        <td class="text-center">
                            <a href="{{url('surat/'.$suratKeluar->id .'/surat-keluar')}}"><i class='menu-icon tf-icons bx bx-folder-open'></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="add" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Surat Keluar</h5>
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
                            <label for="penerima" class="form-label">Penerima</label>
                            <input type="text" id="penerima" wire:model="penerima" class="form-control @error('penerima') is-invalid @enderror" placeholder="Masukan Nama" />
                            @error('penerima')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col mb-0">
                            <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label>
                            <input type="date" id="tanggal_keluar" wire:model="tanggal_keluar" class="form-control @error('tanggal_keluar') is-invalid @enderror" placeholder="DD / MM / YY" />
                            @error('tanggal_keluar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nomor_surat" class="form-label">Perihal</label>
                            <textarea class="form-control @error('perihal') is-invalid @enderror" wire:model="perihal" name="" id=""></textarea>
                            @error('perihal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
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