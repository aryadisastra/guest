@include('header')
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">Bagian Edit</h1>
        <div class="row">
            <div class="col-12 col-lg-6 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Form Bagian</h5>
                    </div>
                    <div class="card-body">
                        <form action="/bagian/edit" class="form" method="post">
                            @csrf
                            <label for="nama-bagian">Nama Bagian</label>
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="col-12 mb-2" >
                                <input type="text" name="nama" id="nama-bagian" class="form-control" placeholder="Bagian" value="{{ ucwords($data->nama_bagian) }}">
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