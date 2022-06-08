@include('header')
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">Pengguna Edit</h1>
        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-9 d-flex" id="warning-notif">
                <div class="card warning flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="text-warning" data-feather="alert-triangle"></i> Notes !</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-danger">*Jika Tidak Ada Perubahan Pada Password Maka Kosongkan Saja Kolom Password</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Form Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <form action="/pengguna/edit" class="form" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <label for="nama-bagian">Nama</label>
                            <div class="col-12 mb-2" >
                                <input type="text" name="nama" id="nama-bagian" class="form-control" placeholder="Nama" value="{{ ucwords($data->nama) }}">
                            </div>
                            <label for="nama-bagian">Username</label>
                            <div class="col-12 mb-2" >
                                <input type="text" name="username" id="nama-bagian" class="form-control" placeholder="Username" value="{{ $data->username }}">
                            </div>
                            <label for="nama-bagian">Password</label>
                            <div class="col-12 mb-2" >
                                <input type="password" name="password" id="nama-bagian" class="form-control" placeholder="Password">
                            </div>
                            <label for="nama-bagian">Bagian</label>
                            <div class="col-12 mb-2" >
                                <select class="form-select mb-3" name="bagian">
                                    <option selected value="0">----</option>
                                    @foreach ($bagian as $item)
                                        <option value="{{ $item->id }}" {{ $data->bagian == $item->id ? 'selected' : '' }}>{{ ucwords($item->nama_bagian) }}</option>
                                    @endforeach
                                  </select>
                            </div>
                            <label for="nama-bagian">Status</label>
                            <div class="col-12 mb-2" >
                                <div>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value="1" {{ $data->status == 1 ? 'checked' : '' }}>
                                        <span class="form-check-label">Aktif</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value="2" {{ $data->status == 2 ? 'checked' : '' }}>
                                        <span class="form-check-label">Non-Aktif</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 mb-2" >
                                <input type="submit" class="btn btn-info" value="Edit Data">
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