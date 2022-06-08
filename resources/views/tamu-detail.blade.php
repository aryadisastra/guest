@include('header')
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">Tamu Detail</h1>
        <div class="row">
            <div class="col-12 col-lg-6 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Form Tamu</h5>
                    </div>
                    <div class="card-body">
                        <form action="/bagian/create" class="form" method="post">
                            @csrf
                            <label for="nama-bagian">Nama</label>
                            <div class="col-12 mb-2" >
                                <input type="text" name="nama" id="nama-bagian" class="form-control" placeholder="Bagian" value="{{ ucwords($data->nama) }}" readonly>
                            </div>
                            <label for="nama-bagian">Nomor Identitas</label>
                            <div class="col-12 mb-2" >
                                <input type="text" name="nama" id="nama-bagian" class="form-control" placeholder="Bagian" value="{{ $data->nomor_ktp }}" readonly>
                            </div>
                            <label for="nama-bagian">Email</label>
                            <div class="col-12 mb-2" >
                                <input type="text" name="nama" id="nama-bagian" class="form-control" placeholder="Bagian" value="{{ $data->email }}" readonly>
                            </div>
                            <label for="nama-bagian">No HP</label>
                            <div class="col-12 mb-2" >
                                <input type="text" name="nama" id="nama-bagian" class="form-control" placeholder="Bagian" value="{{ $data->no_hp }}" readonly>
                            </div>
                            <label for="nama-bagian">Alamat</label>
                            <div class="col-12 mb-2" >
                                <textarea class="form-control"  name="" id="" cols="30" rows="10" readonly>{{ $data->alamat }}</textarea>
                            </div>
                            <label for="nama-bagian">Status</label>
                            <div class="col-12 mb-2" >
                                <input type="text" name="status" id="nama-bagian" class="form-control" placeholder="Bagian" value="{{ $data->status == 1 ? 'Aktif' : 'Non-Aktif' }}" readonly>
                            </div>
                            <div class="col-12 mb-2" >
                                <a href="/tamu" class="btn btn-info">Kembali</a>
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