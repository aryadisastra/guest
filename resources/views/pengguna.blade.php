@include('header')
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">Bagian</h1>
        <div class="row">
            <div class="col-12 col-lg-3 col-sm-9 d-flex">
                <div class="card flex-fill">
                    <a href="/pengguna/create" class="btn btn-primary">Tambah Pengguna</a>
                </div>
            </div>
        </div>
        <div class="row">
            @if (session('success'))
            <div class="col-12 col-lg-12 col-xxl-9 d-flex" id="succes-notif">
                <div class="card success flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="text-info" data-feather="alert-circle"></i> Berhasil !</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-info">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-12 col-lg-12 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
    
                        <h5 class="card-title mb-0">Data Bagian</h5>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="d-none d-xl-table-cell">Nama</th>
                                <th class="d-none d-xl-table-cell">Username</th>
                                <th class="d-none d-xl-table-cell">Bagian</th>
                                <th class="d-none d-xl-table-cell">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;   
                            @endphp
                            @if(count($bagian) == 0)
                            <tr>
                                <td colspan="3" align="center">Data Tidak Ada</td>
                            </tr>
                            @else
                            @foreach ($bagian as $dt)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td><a style="text-decoration: none; color:rgb(71, 177, 68);" href="/pengguna/{{ $dt->id }}">{{ ucwords($dt->nama) }}</a></td>
                                <td>{{ $dt->username }}</td>
                                @php
                                    $bagian = \App\Bagian::where('id',$dt->bagian)->first();
                                @endphp
                                <td>{{ ucwords($bagian->nama_bagian) }}</td>
                                <td><span class="badge {{ $dt->status == 1 ?  'bg-success' : 'bg-danger'}}"> {{ $dt->status == 1 ? 'Aktif' : 'Nonaktif' }}</span></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</main>
<script>
    setTimeout(() => {
        $('#succes-notif').removeClass('d-flex')
        $('#succes-notif').addClass('d-none')
    }, 2000);
</script>
@include('footer')