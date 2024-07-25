<div class="div">
    <div class="container">

        <div class="card mt-2 mb-3 ">
            <div class="d-flex align-items-center justify-content-between row">
                <div class="col-sm-9">
                    <div class="card-body " wire:ignore>
                        <h4 class="card-title text-primary" id="greeting-message">
                            <!-- Placeholder for the dynamic greeting message -->
                        </h4>
                        <p class="fw-bold" id="current-time">
                            <!-- Placeholder for the real-time clock -->
                        </p>
                        <p class="text-muted">
                            Digitalisasi Arsip: Solusi Cerdas untuk Manajemen Disposisi Surat Masuk dan Dokumen Lainnya

                        </p>

                    </div>
                </div>
                <div class="col-sm-3 ">
                    <div class="card-body">
                        <img width="100%" class="" src="{{asset('ui/assets/img/illustrations/undraw_cloud_files_wmo8.svg')}}" alt="View Badge User" />
                    </div>
                </div>
                <!-- <div class="col-sm-5 text-center text-sm-left">
                    <div class="pb-1 px-0 px-md-4 position-relative">
                        <img class="position-absolute" style="top: -130px; right:0" src="{{asset('ui/assets/img/illustrations/undraw_co_workers_re_1i6i.svg')}}" width="280px" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                    </div>
                </div> -->
            </div>
        </div>
        <div class="row ">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="p-2">

                        <div class="d-flex">
                            <div class="avatar flex-shrink-0 me-3 ">
                                <span class="badge bg-label-primary p-2">
                                    <i class="bx bx-trending-up text-primary"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <!-- <small class="text-muted d-block mb-1">Paypal</small> -->
                                    <h6 class="mb-0">Surat Masuk</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0 mx-2 fw-bold">{{$totalMasuk}}</h6>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="p-2">

                        <div class="d-flex">
                            <div class="avatar flex-shrink-0 me-3 ">
                                <span class="badge bg-label-danger p-2">
                                    <i class="bx bx-trending-down text-danger"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <!-- <small class="text-muted d-block mb-1">Paypal</small> -->
                                    <h6 class="mb-0">Surat Keluar</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0 mx-2 fw-bold">{{$totalKeluar}}</h6>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="p-2">

                        <div class="d-flex ">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="badge bg-label-success p-2">
                                    <i class="bx bx-folder text-success"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <!-- <small class="text-muted d-block mb-1">Paypal</small> -->
                                    <h6 class="mb-0">Dokument</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0 mx-2 fw-bold">{{$totalDokument}}</h6>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Striped Rows -->
        <div class="card">
            <div class="d-flex flex-wrap align-items-center  justify-content-between ">
                <h5 class="card-header">
                    Recent Files
                </h5>
                <div class="card-header">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                        <input wire:model.live="searchTerm" type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31" />
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Size</th>
                            <th>Type</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($files as $file)
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
                                    </div>
                                </div>

                            </td>
                            <td>{{$file->size}}</td>
                            <td><span class="badge bg-label-{{$file->status_badge}} me-1">{{$file->dokument}}</span></td>
                            <td>{{ $file->formatted_created_at }}</td>
                        </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex my-3 justify-content-end">
            {{ $files->links('vendor.pagination.simple-bootstrap-5') }}

        </div>
        <!--/ Striped Rows -->
    </div>
</div>
@push('scripts')
<script>
    function updateGreetingAndTime() {
        const now = new Date();
        // Add one hour
        now.setHours(now.getHours() + 1);

        // Determine the greeting based on the adjusted time
        const hour = now.getHours();
        let greeting;
        if (hour >= 5 && hour < 12) {
            greeting = 'Selamat Pagi'; // Good Morning
        } else if (hour >= 12 && hour < 17) {
            greeting = 'Selamat Siang'; // Good Afternoon
        } else if (hour >= 17 && hour < 19) {
            greeting = 'Selamat Sore'; // Good Evening
        } else {
            greeting = 'Selamat Malam'; // Good Night
        }

        // Format the time
        const options = {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            timeZone: 'Asia/Jakarta'
        };
        const timeString = now.toLocaleString('id-ID', options);

        // Update the DOM elements
        document.getElementById('greeting-message').textContent = `${greeting}, {{ auth()->user()->name }}`;
        document.getElementById('current-time').textContent = timeString;
    }

    // Update the greeting and time immediately
    updateGreetingAndTime();

    // Update the time every second
    setInterval(updateGreetingAndTime, 1000);
</script>
@endpush