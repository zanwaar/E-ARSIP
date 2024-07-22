<div class="container-xxl flex-grow-1">
    <div class="bg-white my-3 rounded">
        <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row px-4 py-2 ">
            <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Dokument /</span> Surat Disposisi </h4>
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


            </div>
            <div class="card-title d-flex flex-row">
                <div class="d-flex flex-column mx-2 w-100  text-black">
                    <small class="d-block text-secondary">Dokument File Surat Masuk</small>
                    @foreach ($suratDisposisi->dokuments as $dokument)
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

                    <!-- <a href="" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="dz-w-8 dz-h-8 dz-text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"></path>
                            </svg>
                            <i class="bx bxs-file-pdf display-5 cursor-pointer text-danger"></i>
                        </a> -->
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

</div><!-- End Recent Activity -->

</div>