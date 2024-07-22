<div class="container-xxl flex-grow-1">
    <div class="bg-white my-3 rounded">
        <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row px-4 py-2 ">
            <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Jabatan /</span> List Jabatan</h4>
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

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>jabatan</th>
                        <th>Descriotion</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($jabatans as $jabatan)
                        <tr>
                            <td><strong>{{$jabatan->name}}</strong></td>
                            <td>{{$jabatan->description}}</td>
                            <td>

                                <div class="d-flex">
                                    <a class="dropdown-item" wire:click.prevent="confirmRemoval({{ $jabatan }})"><i class="bx bx-trash me-1"></i> Delete</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="text-center pt-4">
                    <h4>Konfirmasi Delete</h4>
                    @if ($idBeingRemoved)
                    {{$mjabatan['name']}}
                    @endif
                </div>

                <div class="d-flex flex-column px-3 py-3">
                    <button type="button" wire:click.prevent="delete" class="btn btn-danger mb-2"><i class="fa fa-trash mr-1"></i>Delete</button>
                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
                </div>
            </div>
        </div>
    </div>



</div>
@push('scripts')
<script>
    var modal = new bootstrap.Modal(document.getElementById('confirmationModal'), {
        backdrop: 'static',
        keyboard: false
    });
    window.addEventListener("hide-form", function(event) {
        $("#confirmationModal").modal("hide");
    });
    window.addEventListener("show-delete-modal", function(event) {
        $("#confirmationModal").modal("show");
        // modal.show();
    });
</script>
@endpush