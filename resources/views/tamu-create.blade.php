@include('header')
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">Tamu Create</h1>
        <div class="row">
            <div class="col-12 col-lg-6 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Form Tamu</h5>
                    </div>
                    <div class="card-body">
                        <form action="/tamu/create" class="form" method="post">
                            @csrf
                            <label for="nama-bagian">Nama</label>
                            <div class="col-12 mb-3" >
                                <input type="text" name="nama" id="nama-bagian" class="form-control" placeholder="Nama">
                            </div>
                            <label for="username">No Identitas</label>
                            <div class="col-12 mb-3" >
                                <input type="text" name="no_ktp" id="nama-bagian" class="form-control" placeholder="No Identitas">
                            </div>
                            <label for="username">Email</label>
                            <div class="col-12 mb-3" >
                                <input type="email" name="email" id="nama-bagian" class="form-control" placeholder="tamu@gmail.com">
                            </div>
                            <label for="username">No HP</label>
                            <div class="col-12 mb-3" >
                                <input type="text" name="no_hp" id="nama-bagian" class="form-control" placeholder="No HP">
                            </div>
                            <label for="username">Alamat</label>
                            <div class="col-12 mb-3" >
                                <textarea name="alamat" id="" cols="30" rows="5" class="form-control" ></textarea>
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