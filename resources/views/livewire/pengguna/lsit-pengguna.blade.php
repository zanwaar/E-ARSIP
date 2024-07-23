<div class="container-xxl flex-grow-1">
    <div class="bg-white my-3 rounded">
        <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row px-4 py-2 ">
            <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Pengguna /</span> List Pengguna</h4>
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
    <div class="d-flex mb-3">
        <div class="btn-group  " role="group" aria-label="Basic example">
            <button type="button" class="btn-sm {{$selectedJabatan == 'ALL' ? 'btn btn-primary' : 'btn btn-outline-primary'}}" wire:click="filterByJabatan('ALL')">ALL</button>
            <button type="button" class="btn-sm {{$selectedJabatan == 'KADIS' ? 'btn btn-primary' : 'btn btn-outline-primary'}}" wire:click="filterByJabatan('KADIS')">KADIS</button>
            <button type="button" class="btn-sm {{$selectedJabatan == 'KABIB' ? 'btn btn-primary' : 'btn btn-outline-primary'}}" wire:click="filterByJabatan('KABIB')">KABIB</button>
            <button type="button" class="btn-sm {{$selectedJabatan == 'STAFF' ? 'btn btn-primary' : 'btn btn-outline-primary'}}" wire:click="filterByJabatan('STAFF')">STAFF</button>
        </div>
    </div>



    <div class="card mb-3">
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
                        <td><strong>{{$user->name}}</strong></td>
                        <td>{!! $user->jabatans ? '<span class="badge bg-label-'.$user->jabatans->status_badge .' me-1">' .$user->jabatans->alias .'</span> ' . $user->jabatans->bidang->name : '<span class="badge bg-label-danger me-1">N/A</span>' !!}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->notlpn}}</td>
                        <td></td>


                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    {{ $users->links() }}


</div>