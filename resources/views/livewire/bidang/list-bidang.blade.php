<div class="container-xxl flex-grow-1">
    <div class="bg-white my-3 rounded">
        <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row px-4 py-2 ">
            <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Bidang /</span> List Bidang</h4>
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
    <div class="d-flex justify-content-between pb-2">
        <div class="btn-group" role="group" aria-label="Second group">
            <a href="{{route('bidang.create.bidang')}}" type="button" class="btn btn-primary btn-sm">
                <i class="bx bx-folder-plus"></i>
                <span style="font-size: 13px;"> Tambah Bidang</span>
            </a>
        </div>
        <div class="">
            {{ $listBidang->links('vendor.pagination.simple-bootstrap-5') }}

        </div>

    </div>
    <div class="card mb-3">
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
                        <td><strong>{{$bidang->name}}</strong></td>
                        <td>{!! $bidang->kepalaBidang ? $bidang->kepalaBidang->user->name : '<span class="badge bg-label-danger me-1">N/A</span>' !!}</td>
                        <td>{!! $bidang->kepalaSeksi ? $bidang->kepalaSeksi->user->name : '<span class="badge bg-label-danger me-1">N/A</span>' !!}</td>
                        <td class="text-center ">{{ $bidang->total_staff }}</td>
                        <td>
                            <a href="{{url('bidang/' .$bidang->id .'/detail')}}"><i class='menu-icon tf-icons bx bx-briefcase-alt-2'></i>Detail</a>

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
                    {{$mbidang['name']}}
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