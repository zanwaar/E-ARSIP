<div class="container-xxl flex-grow-1">
    <div class="bg-white my-3 rounded">
        <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row px-4 py-2 ">
            <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Bidang / Detail /</span> {{$bidang->name}}</h4>
            <div class="">
                <!-- <a href="" class="btn btn-primary">Tambah</a> -->
                <!-- Button trigger modal -->
                <!-- <div class="input-group input-group-merge">
                    <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31" />
                </div> -->



            </div>
        </div>
    </div>
    <div class="container-xxl rounded   bg-white">

        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        @if ($bidang->kepalaBidang)
                        <img src="{{$bidang->kepalaBidang->user->avatar_url}}" alt="Profile" width="200px" height="200px" class="rounded-circle mb-3">

                        @else
                        <img src="{{url('storage/avatars/noimage.png')}}" alt="Profile" width="200px" height="200px" class="rounded-circle mb-3">

                        @endif
                        <h5 class="card-title">Kepala {{$bidang->name}}</h5>
                        <p class="card-text">{!! $bidang->kepalaBidang ? $bidang->kepalaBidang->user->name : '<span class="badge bg-label-warning me-1">N/A</span>' !!}</p>
                    </div>
                </div>

            </div>
            <div class="col-md-6">

                <div class="">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        @if ($bidang->kepalaSeksi)

                        <img src="{{$bidang->kepalaSeksi->user->avatar_url}}" alt="Profile" width="200px" height="200px" class="rounded-circle mb-3">
                        @else
                        <img src="{{url('storage/avatars/noimage.png')}}" alt="Profile" width="200px" height="200px" class="rounded-circle mb-3">

                        @endif
                        <h5 class="card-title">Kepala Seksi {{$bidang->name}}</h5>
                        <p class="card-text"> {!! $bidang->kepalaSeksi ? $bidang->kepalaSeksi->user->name : '<span class="badge bg-label-warning me-1">N/A</span>' !!}</p>
                    </div>
                </div>

            </div>
        </div>

        <div class="divider">
            <div class="divider-text">
                <i class="bx bx-star"></i>
            </div>
        </div>
        <!-- Horizontal -->
        <h5 class="pb-1 mb-4">Staff {{$bidang->name}}</h5>
        <div class="row mb-5">
            @foreach ($bidang->staff as $staff)
            <div class="col-md-6">
                <div class=" mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{$staff->user->avatar_url}}" a alt="Profile" class="card-img card-img-left">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"> {{$staff->user->name}}</h5>
                                <p class="card-text">
                                    {{$staff->user->email}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach

        </div>
        <!--/ Horizontal -->
    </div>

</div>