@include('header')
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">Pengguna Create</h1>
        <div class="row">
            <div class="col-12 col-lg-6 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Form Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <form action="/pengguna/create" class="form" method="post">
                            @csrf
                            <label for="nama-bagian">Nama</label>
                            <div class="col-12 mb-3" >
                                <input type="text" name="nama" id="nama-bagian" class="form-control" placeholder="Nama">
                            </div>
                            <label for="username">Username</label>
                            <div class="col-12 mb-3" >
                                <input type="text" name="username" id="nama-bagian" class="form-control" placeholder="Username">
                            </div>
                            <label for="username">Password</label>
                            <div class="col-12 mb-3" >
                                <input type="password" name="password" id="nama-bagian" class="form-control" >
                            </div>
                            <label for="username">Bagian</label>
                            <div class="col-12 mb-3" >
                                <select class="form-select mb-3" name="bagian">
                                    <option selected value="0">----</option>
                                    @foreach ($bagian as $item)
                                        <option value="{{ $item->id }}">{{ ucwords($item->nama_bagian) }}</option>
                                    @endforeach
                                  </select>
                            </div>
                            <div class="col-2" style="margin-top: 20px">
                                <input type="submit" class="btn btn-info" value="Tambah">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if (session('error'))
            <div class="col-12 col-lg-6 col-xxl-9 d-flex">
                <div class="card error flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="text-danger" data-feather="alert-circle"></i> Gagal !</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-danger">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
</main>
@include('footer')