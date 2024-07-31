<div class="container">
    <div class="card my-3">
        <div class="py-2 px-4">
            <div class="d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" name="search" value="" class="form-control border-0 shadow-none" placeholder="Pencarian..." aria-label="Pencarian..." />
            </div>
        </div>
    </div>
    <h4 class="fw-bold ">
        <span class="text-muted fw-light">Dokument /</span>
        Surat Disposisi
    </h4>
    @empty(!$suratDisposisi)
    @foreach ($suratDisposisi as $surat)
    <div class="card mb-3 border {{$surat->is_read ? '' : 'border-primary shadow-lg'}}">
        <div class="card-body">
            <div class="d-flex justify-content-between ">
                <div class="card-title  d-flex flex-row">
                    <div class="d-inline-block mx-2  text-black">
                        <small class="d-block text-secondary">Nomor Surat</small>
                        {{$surat->suratMasuk->nomor_surat}}
                    </div>
                </div>
                <div class=" card-title d-flex flex-row">
                    <div class="d-inline-block mx-2 text-end text-black">
                        <small class="d-block text-secondary">Tanggal Dokument</small>
                        {{ $surat->suratMasuk->tanggal_masuk }}
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between ">
                <div class="card-title d-flex flex-row">
                    <div class="d-inline-block mx-2 text-black">
                        <small class="d-block text-secondary">Perihal</small>
                        {{$surat->suratMasuk->perihal}}
                    </div>

                </div>
                <div class="d">
                    @if (!$surat->is_read)
                    <div class="btn-group" role="group" aria-label="Second group">
                        <button wire:click.prevent="add({{ $surat }})" type="button" class="btn btn-primary">
                            <i class="bx bx-mail-send me-1"></i>
                            <span style="font-size: 13px;">Disposisikan</span>
                        </button>
                    </div>

                    @else
                    <div class="d-flex flex-column">
                        <p class="text-black text-end "> <span class="d-block text-secondary">Keterangan Disposisi</span>{{$surat->suratMasuk->disposisis[2]->isi_disposisi}}</p>
                        <div class="d-flex justify-content-end">
                            <a class="" href="{{url('surat-disposisi/' .$surat->suratMasuk->id .'/disposisi')}}"><i class='bx bx-mail-send me-2'></i>Traking Surat Disposisi</a>
                        </div>
                    </div>

                    @endif
                </div>

            </div>
            <div class="card-title d-flex flex-row">
                <div class="d-flex flex-column mx-2 w-100  text-black">
                    <small class="d-block text-secondary">Dokument File Surat Masuk</small>
                    @foreach ($surat->suratMasuk->dokuments as $dokument)
                    @if ($dokument->dokument == 'SURAT MASUK')
                    <form action="{{ route('getPdf') }}" method="POST" target="_blank">
                        @csrf
                        <input type="hidden" name="file" value="{{ $dokument->file }}">
                        <button type="submit" class="dz-flex dz-flex-wrap dz-gap-x-10 dz-gap-y-2 dz-justify-start dz-w-full mt-2">
                            <div class="dz-flex dz-items-center dz-justify-between dz-gap-2 dz-border dz-rounded dz-border-gray-200 dz-w-full dz-h-auto dz-overflow-hidden dark:dz-border-gray-700">
                                <div class="dz-flex dz-items-center dz-gap-3">
                                    <div class="dz-flex dz-justify-center dz-items-center dz-w-14 dz-h-14 dz-bg-gray-100 dark:dz-bg-gray-700">
                                        <i class="bx bxs-file-pdf display-4 cursor-pointer text-danger"></i>
                                    </div>
                                    <div class="dz-flex dz-flex-col dz-items-start dz-gap-1">
                                        <div class="dz-text-center  dz-text-sm dz-font-medium " style="padding-right: 15px;">{{ $dokument->file }}</div>
                                        <div class="dz-text-center dz-text-gray-500 dz-text-sm dz-font-medium">{{ $dokument->size }}</div>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </form>

                    @endif
                    @endforeach

                </div>
            </div>
            <hr>

        </div>
    </div>
    @endforeach
    {{ $suratDisposisi->links('vendor.pagination.bootstrap-5')  }}
    @endempty


    <!-- Modal Tambah Surat Masuk -->
    <div class="modal fade" id="add" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form wire:submit.prevent="addTask">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">DISPOSISI</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="py-1 rounded" wire:ignore>
                            <select class="mySelect2 py-1 rounded" style=" width: 100%; ">
                                <option selected>-- Opsi --</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nomor_surat" class="form-label">ISI DISPOSISI</label>
                                <textarea class="form-control" wire:model="isi"></textarea>
                            </div>
                        </div>
                        <!-- FILE DOKUMENT SURAT -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
<style>
    .select2-container .select2-selection--single {
        height: 41px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 39px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 7px !important;
        right: 4px !important;
        width: 22px !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = new bootstrap.Modal(document.getElementById('add'), {
            backdrop: 'static',
            keyboard: false
        });
        // Initialize Select2
        $('.mySelect2').select2({
            dropdownParent: $('#add'), // Ensure dropdown is within modal
            ajax: {
                url: '{{ route("fetch") }}',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    console.log(data)
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name
                        }))
                    };
                },
                cache: true
            }
        }).on('change', function(e) {
            @this.set('user_id', e.target.value);
        });

        // Show and hide modal event listeners
        window.addEventListener("hide-form", function(event) {
            $("#add").modal("hide");
        });

        window.addEventListener("show-modal-add", function(event) {
            $("#add").modal("show");
        });
    });
</script>
@endpush