<div class="container-xxl flex-grow-1">
    <div class="bg-white my-3 rounded">
        <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row px-4 py-2 ">
            <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Dokument /</span> Surat Keluar</h4>
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
    <div class="card mb-3">
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nomor Surat</th>
                        <th>Penerima</th>
                        <th>Tanggal Keluar</th>
                        <th>Perihal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suratKeluars as $suratKeluar)
                    <tr>
                        <td>{{ $suratKeluar->nomor_surat }}</td>
                        <td>{{ $suratKeluar->penerima }}</td>
                        <td>{{ $suratKeluar->tanggal_keluar }}</td>
                        <td>{{ $suratKeluar->perihal }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $suratKeluars->links() }}
</div>