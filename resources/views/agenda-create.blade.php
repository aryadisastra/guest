@include('header')
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">Agenda Create</h1>
        <div class="row">
            <div class="col-12 col-lg-6 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Form Agenda</h5>
                    </div>
                    <div class="card-body">
                        <form action="/agenda/create" class="form" method="post">
                            @csrf
                            <label for="nama-bagian">Acara</label>
                            <div class="col-12 mb-3" >
                                <input type="text" name="acara" id="nama-bagian" class="form-control">
                            </div>
                            <label for="username">Tanggal Mulai</label>
                            <div class="col-12 mb-3" >
                                <input type="date" name="tanggal_dimulai" id="nama-bagian" class="form-control" >
                            </div>
                            <label for="username">Tanggal Selesai</label>
                            <div class="col-12 mb-3" >
                                <input type="date" name="tanggal_selesai" id="nama-bagian" class="form-control" >
                            </div>
                            <label for="username">Koordinator</label>
                            <div class="col-12 mb-3" >
                                <select class="form-select mb-3" name="koordinator">
                                    <option selected value="0">----</option>
                                    @foreach ($pengguna as $item)
                                        <option value="{{ $item->id }}">{{ ucwords($item->nama) }}</option>
                                    @endforeach
                                  </select>
                            </div>
                            <label for="username">Tempat</label>
                            <div class="col-12 mb-3" >
                                <textarea name="tempat" class="form-control" id="" cols="30" rows="5"></textarea>
                            </div>
                            <label for="username">Anggaran</label>
                            <div class="col-12 mb-3" >
                                <input type="text" name="anggaran" id="nama-bagian" class="form-control" >
                            </div>
                            <label for="username">Catatan</label>
                            <div class="col-12 mb-3" >
                                <textarea name="catatan" class="form-control" id="" cols="30" rows="5"></textarea>
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