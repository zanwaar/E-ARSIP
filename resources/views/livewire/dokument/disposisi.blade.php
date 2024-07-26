<div class="container-xxl flex-grow-1">
    <div class="bg-white my-3 rounded">
        <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row px-4 py-2 ">
            <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Dokument /</span> Surat Masuk </h4>
            @role('staffAdmin')
            <div class="">
                <div class="btn-group" role="group" aria-label="Second group">
                    <button wire:click="show()" type="button" class="btn btn-dark">
                        <!-- <i class="bx bx-folder-plus"></i> -->
                        <span style="font-size: 13px;">Edit Surat Masuk</span>
                    </button>
                </div>
            </div>
            @endrole
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between ">
                <div class="card-title d-flex flex-row">
                    <div class="d-inline-block mx-2  text-black">
                        <small class="d-block text-secondary">Nomor Surat</small>
                        {{$suratDisposisi->nomor_surat}}
                    </div>
                </div>
                <div class="card-title d-flex flex-row">
                    <div class="d-inline-block mx-2 text-end text-black">
                        <small class="d-block text-secondary">Tanggal Dokument</small>
                        {{ $suratDisposisi->tanggal_masuk }}
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between ">
                <div class="card-title d-flex flex-row">
                    <div class="d-inline-block mx-2 text-black">
                        <small class="d-block text-secondary">Perihal</small>
                        {{$suratDisposisi->perihal}}
                    </div>
                </div>
                <div class="card-title d-flex flex-row">
                    <div class="d-inline-block mx-2 text-end text-black">
                        <small class="d-block text-secondary">Pengirim</small>
                        {{ $suratDisposisi->pengirim }}
                    </div>
                </div>

            </div>
            <div class="card-title d-flex flex-row">
                <div class="d-flex flex-column mx-2 w-100  text-black">
                    <small class="d-block text-secondary">Dokument File Surat Masuk</small>
                    @foreach ($suratDisposisi->dokuments as $dokument)
                    @if ($dokument->dokument == 'SURAT MASUK')
                    <div class="dz-flex dz-flex-wrap dz-gap-x-10 dz-gap-y-2 dz-justify-start dz-w-full dz-mt-2">
                        <!--[if BLOCK]><![endif]-->
                        <form action="{{ route('getPdf') }}" method="POST" target="_blank" class="dz-flex dz-items-center dz-justify-between dz-gap-2 dz-border dz-rounded dz-border-gray-200 dz-w-full dz-h-auto dz-overflow-hidden dark:dz-border-gray-700">
                            @csrf
                            <input type="hidden" name="file" value="{{ $dokument->file }}">
                            <button class="dz-flex dz-items-center dz-gap-3 w-100 dz-cursor-pointer">
                                <div type="submit" class="dz-flex dz-justify-center dz-items-center dz-w-14 dz-h-14 dz-bg-gray-100 dark:dz-bg-gray-700">
                                    <i class="bx bxs-file-pdf display-4 cursor-pointer text-danger"></i>
                                </div>
                                <div class="dz-flex dz-flex-col dz-items-start dz-gap-1">
                                    <div class="dz-text-center  dz-text-sm dz-font-medium " style="padding-right: 15px;">{{ $dokument->file }}</div>
                                    <div class="dz-text-center dz-text-gray-500 dz-text-sm dz-font-medium">{{ $dokument->size }}</div>
                                </div>
                            </button>
                            @role('staffAdmin')
                            <div wire:click="showDelete({{ $dokument->id }})" class="dz-flex dz-items-center dz-mr-3">
                                <button type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="dz-w-6 dz-h-6 dz-text-black dark:dz-text-white">
                                        <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                            @endrole
                        </form>
                        <!--[if ENDBLOCK]><![endif]-->
                    </div>
                    @endif

                    @endforeach
                </div>
            </div>
            <hr>
            <div class="mx-2">
                <h5 class="card-title ">Disposisi Activity | <span class="text-primary">{{$suratDisposisi->disposisis->count() > 1 ? $suratDisposisi->disposisis[1]->user->jabatans->bidang->name  : ''}}</span> </h5>
                <div class="activity ">
                    @foreach ($suratDisposisi->disposisis as $disposisi)
                    <div class="activity-item d-flex">
                        <div class="activite-label">{{ $disposisi->formatted_created_at }}</div>
                        <i class='bx bxs-circle activity-badge text-{{$disposisi->user?->jabatans->status_badge}} align-self-start'></i>
                        <div class="activity-content">

                            <span class="badge bg-label-{{$disposisi->user?->jabatans->status_badge ?? 'success' }} me-1">{{ $disposisi->user?->jabatans->alias ?? 'STAFF'   }}</span> | {{ $disposisi->user ? $disposisi->user?->name : $disposisi->bidang->name }}
                            <p>{{ $disposisi->isi_disposisi }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @role('staffAdmin')
    <div class="card mt-3">
        <h5 class="card-header">Hapus Surat Masuk</h5>
        <div class="card-body">
            <div class="mb-3 col-12 mb-0">
                <div class="alert alert-warning">
                    <h6 class="alert-heading fw-bold mb-1">Apakah Anda yakin ingin menghapus Surat ini?</h6>
                    <p class="mb-0">Setelah Anda menghapus Surat Masuk ini, semua data terkait akan dihapus secara permanen dan tidak dapat dikembalikan. Mohon pastikan keputusan Anda.</p>
                </div>
            </div>
            <form id="formBidangDeletion" wire:submit.prevent="delete">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="confirmDeletion" id="confirmDeletion" wire:model="confirmDeletion" />
                    <label class="form-check-label" for="confirmDeletion">Saya mengonfirmasi penghapusan Surat Masuk ini</label>
                </div>
                <button type="submit" class="btn btn-danger">Hapus Surat Masuk</button>
            </form>
        </div>
    </div>
    <div class="modal fade" id="file" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="bx bxs-file-pdf display-4 cursor-pointer text-danger"></i>
                    <p>Are you sure you want to delete the file?</p>

                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-secondary w-100 dz-block" data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="submit" wire:click="deletefile" class="btn btn-danger w-100 dz-block ">
                                <div data-i18n="Analytics">Yes, Delete</div>
                            </button>
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
                    <h5 class="modal-title" id="exampleModalLabel1">Surat Masuk</h5>
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
    @endrole

</div>
@role('staffAdmin')
@push('scripts')
<script>
    var modal = new bootstrap.Modal(document.getElementById('add'), {
        backdrop: 'static',
        keyboard: false
    });
    var modal = new bootstrap.Modal(document.getElementById('file'), {
        backdrop: 'static',
        keyboard: false
    });
    window.addEventListener("hide-form", function(event) {
        $("#add").modal("hide");
        $("#file").modal("hide");
    });
    window.addEventListener("show-modal-add", function(event) {
        $("#add").modal("show");
    });
    window.addEventListener("show-modal-file", function(event) {
        $("#file").modal("show");
    });
</script>
@endpush
@endrole