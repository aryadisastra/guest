@include('header')
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">Pengguna Detail</h1>
        <div class="row">
            <div class="col-12 col-lg-6 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Form Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <form action="/bagian/create" class="form" method="post">
                            @csrf
                            <label for="nama-bagian">Acara</label>
                            <div class="col-12 mb-2" >
                                <input type="text" name="nama" id="nama-bagian" class="form-control" placeholder="Bagian" value="{{ ucwords($data->acara) }}" readonly>
                            </div>
                            <label for="nama-bagian">Tanggal Mulai</label>
                            <div class="col-12 mb-2" >
                                <input type="text" name="username" id="nama-bagian" class="form-control" placeholder="Bagian" value="{{$data->tanggal_dimulai }}" readonly>
                            </div>
                            <label for="nama-bagian">Tanggal Selesai</label>
                            <div class="col-12 mb-2" >
                                <input type="text" name="username" id="nama-bagian" class="form-control" placeholder="Bagian" value="{{$data->tanggal_dimulai }}" readonly>
                            </div>
                            <label for="nama-bagian">Koordinator</label>
                            <div class="col-12 mb-2" >
                                @php
                                    $koordinator = \App\Pengguna::where('id',$data->koordinator)->first();
                                    $pengguna = \App\Pengguna::where('id',$data->created_by)->first();
                                @endphp
                                <input type="text" name="bagian" id="nama-bagian" class="form-control" placeholder="Bagian" value="{{$koordinator->nama }}" readonly>
                            </div>
                            <label for="nama-bagian">Tempat</label>
                            <div class="col-12 mb-2" >
                                <textarea name="" id="" class="form-control" cols="30" rows="5"  readonly>{{ $data->tempat }}</textarea>
                            </div>
                            <label for="nama-bagian">Anggaran</label>
                            <div class="col-12 mb-2" >
                                <input type="text" name="username" id="nama-bagian" class="form-control" placeholder="Bagian" value="{{'Rp. '.$data->anggaran }}" readonly>
                            </div>
                            <label for="nama-bagian">Catatan</label>
                            <div class="col-12 mb-2" >
                                <textarea name="" id="" class="form-control" cols="30" rows="5"  readonly> {{ $data->catatan }}</textarea>
                            </div>
                            <label for="nama-bagian">Dibuat Oleh</label>
                            <div class="col-12 mb-2" >
                                <input type="text" name="username" id="nama-bagian" class="form-control" placeholder="Bagian" value="{{$pengguna->nama }}" readonly>
                            </div>
                            <label for="nama-bagian">Status</label>
                            <div class="col-12 mb-2" >
                                <input type="text" name="username" id="nama-bagian" class="form-control" placeholder="Bagian" value="{{ $data->status == 0 ? 'Belum Dimulai' : ($data->status == 1 ? 'Sedang Berlangsung' : 'Sudah Selesai') }}" readonly>
                            </div>
                            <label for="nama-bagian">Status Persetujuan</label>
                            <div class="col-12 mb-2" >
                                <input type="text" name="username" id="nama-bagian" class="form-control" placeholder="Bagian" value="{{ $data->status_persetujuan != 0 ? 'Dilanjutkan' : 'Di Tolak' }}" readonly>
                            </div>
                            <div class="col-12 mb-2" >
                                @if(session('user')['id'] == 1 || session('user')['id'] == 3)
                                <a href="/agenda/edit/{{ $data->id }}" class="btn btn-info">Edit</a>
                                @elseif(session('user') != 1 && $data->status_persetujuan != 0 && $data->status_persetujuan + 1 == session('user')['id'] && session('user')['id'] != 3)
                                <a href="/agenda/update-status/{{ $data->id }}" class="btn btn-success">Setujui</a>
                                <a href="/agenda/reject-status/{{ $data->id }}" class="btn btn-danger">Tolak</a>
                                @elseif(session('user')['id'] == 2 && $data->status_persetujuan + 1 == 5)
                                <a href="/agenda/invite-guest/{{ $data->id }}" class="btn btn-success">Buat Undangan</a>
                                @endif
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