<div class="div">
    <div class="container">

        <div class="card mt-2 mb-3 ">
            <div class="d-flex align-items-center justify-content-between row">
                <div class="col-sm-9">
                    <div class="card-body ">
                        <h4 class="card-title text-primary">Selamat Siang, {{auth()->user()->name}}</h4>
                        <p class="fw-bold">
                            Kamis, 11 Juli 2024
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
        <div class="row pb-3">
            <div class="col-md-4 ">
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
                                    <h6 class="mb-0">0</h6>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ">
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
                                    <h6 class="mb-0">0</h6>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ">
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
                                    <h6 class="mb-0">0</h6>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Striped Rows -->
        <div class="card">
            <div class="d-flex justify-content-between ">
                <h5 class="card-header">
                    Recent Files
                </h5>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Size</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td class="d-flex align-items-center">
                                <i class="bx bxs-file-pdf display-5 cursor-pointer text-danger px-2"></i>
                                <span class="">2024_APLIKASI PENGARSIPAN DATA ELEKTRONIK.pdf</span>
                            </td>
                            <td>290 KB</td>
                            <td><span class="badge bg-label-danger me-1">SURAT KELUAR</span></td>
                            <td>Kamis, 11 Juli 2024 </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex align-items-center">
                                <i class="bx bxs-file-pdf display-5 cursor-pointer text-danger px-2"></i>
                                <span class="">2024_APLIKASI PENGARSIPAN DATA ELEKTRONIK.pdf</span>
                            </td>
                            <td>290 KB</td>
                            <td><span class="badge bg-label-success me-1">DOKUMENT</span></td>
                            <td>Kamis, 11 Juli 2024 </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex align-items-center">
                                <i class="bx bxs-file-pdf display-5 cursor-pointer text-danger px-2"></i>
                                <span class="">2024_APLIKASI PENGARSIPAN DATA ELEKTRONIK.pdf</span>
                            </td>
                            <td>290 KB</td>
                            <td><span class="badge bg-label-primary me-1">SURAT MASUK</span></td>
                            <td>Kamis, 11 Juli 2024 </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex align-items-center">
                                <i class="bx bxs-file-pdf display-5 cursor-pointer text-danger px-2"></i>
                                <span class="">2024_APLIKASI PENGARSIPAN DATA ELEKTRONIK.pdf</span>
                            </td>
                            <td>290 KB</td>
                            <td><span class="badge bg-label-primary me-1">SURAT MASUK</span></td>
                            <td>Kamis, 11 Juli 2024 </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex align-items-center">
                                <i class="bx bxs-file-pdf display-5 cursor-pointer text-danger px-2"></i>
                                <span class="">2024_APLIKASI PENGARSIPAN DATA ELEKTRONIK.pdf</span>
                            </td>
                            <td>290 KB</td>
                            <td><span class="badge bg-label-primary me-1">SURAT MASUK</span></td>
                            <td>Kamis, 11 Juli 2024 </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex align-items-center">
                                <i class="bx bxs-file-pdf display-5 cursor-pointer text-danger px-2"></i>
                                <span class="">2024_APLIKASI PENGARSIPAN DATA ELEKTRONIK.pdf</span>
                            </td>
                            <td>290 KB</td>
                            <td><span class="badge bg-label-primary me-1">SURAT MASUK</span></td>
                            <td>Kamis, 11 Juli 2024 </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex align-items-center">
                                <i class="bx bxs-file-pdf display-5 cursor-pointer text-danger px-2"></i>
                                <span class="">2024_APLIKASI PENGARSIPAN DATA ELEKTRONIK.pdf</span>
                            </td>
                            <td>290 KB</td>
                            <td><span class="badge bg-label-primary me-1">SURAT MASUK</span></td>
                            <td>Kamis, 11 Juli 2024 </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex align-items-center">
                                <i class="bx bxs-file-pdf display-5 cursor-pointer text-danger px-2"></i>
                                <span class="">2024_APLIKASI PENGARSIPAN DATA ELEKTRONIK.pdf</span>
                            </td>
                            <td>290 KB</td>
                            <td><span class="badge bg-label-primary me-1">SURAT MASUK</span></td>
                            <td>Kamis, 11 Juli 2024 </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex align-items-center">
                                <i class="bx bxs-file-pdf display-5 cursor-pointer text-danger px-2"></i>
                                <span class="">2024_APLIKASI PENGARSIPAN DATA ELEKTRONIK.pdf</span>
                            </td>
                            <td>290 KB</td>
                            <td><span class="badge bg-label-primary me-1">SURAT MASUK</span></td>
                            <td>Kamis, 11 Juli 2024 </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex align-items-center">
                                <i class="bx bxs-file-pdf display-5 cursor-pointer text-danger px-2"></i>
                                <span class="">2024_APLIKASI PENGARSIPAN DATA ELEKTRONIK.pdf</span>
                            </td>
                            <td>290 KB</td>
                            <td><span class="badge bg-label-primary me-1">SURAT MASUK</span></td>
                            <td>Kamis, 11 Juli 2024 </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Striped Rows -->
    </div>
</div>