<div class="container-xxl flex-grow-1">
    <div class="mt-4 rounded">
        <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row ">
            <h4 class="fw-bold "><span class="text-muted fw-light">Dokument /</span> File Lainnya</h4>
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
                        <span style="font-size: 13px;">Tambah File</span>
                    </button>
                </div>

            </div>
            {{ $dokument->links('vendor.pagination.simple-bootstrap-5') }}
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($dokument as $file)
                    <tr>

                        <td class="d-flex align-items-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bxs-file-pdf display-5 cursor-pointer text-danger px-2"></i>
                                    <span class="">{{$file->file}}</span>
                                </button>
                                <div class="dropdown-menu border border-primary w-100 rounded">
                                    <a class="dropdown-item" href="#">
                                        <span class="text-primary">{{$file->file}}</span>
                                    </a>
                                    <form class="dropdown-item" action="{{ route('view.pdf') }}" method="POST" target="_blank">
                                        @csrf
                                        <input type="hidden" name="file" value="{{$file->file}}">
                                        <button type="submit">Download File</button>
                                    </form>
                                    <form class="dropdown-item" action="{{ route('getPdf') }}" method="POST" target="_blank">
                                        @csrf
                                        <input type="hidden" name="file" value="{{$file->file}}">
                                        <button type="submit">View File</button>
                                    </form>
                                    <button class="dropdown-item" wire:click="showDelete({{ $file->id }})">
                                        <span class="">Delete File</span>
                                    </button>
                                </div>
                            </div>

                        </td>
                        <td>{{$file->size}}</td>
                        <td>{{ $file->formatted_created_at }}</td>
                    </tr>
                    @endforeach



                </tbody>
            </table>
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
                    <h5 class="modal-title" id="exampleModalLabel1">File Dokument</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <livewire:dropzone wire:model="files" :rules="['mimes:pdf']" :multiple="true" :key="'dropzone-two'" />
                    <!-- FILE DOKUMENT SURAT -->
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