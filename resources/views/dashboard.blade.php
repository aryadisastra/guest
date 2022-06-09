@include('header')
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">Dashboard</h1>
	</div>
	@if(session('guest'))
	<div class="row">
		
		<div class="col-12 col-lg-12 col-xxl-9 d-flex">
			<div class="card flex-fill">
				<div class="card-header">

					<h5 class="card-title mb-0">Data Undangan</h5>
				</div>
				<table class="table table-hover my-0">
					<thead>
						<tr>
							<th>#</th>
							<th class="d-none d-xl-table-cell">Acara</th>
							<th class="d-none d-xl-table-cell">Tanggal Acara</th>
							<th class="d-none d-xl-table-cell">Keterangan</th>
							<th class="d-none d-xl-table-cell">.....</th>
						</tr>
					</thead>
					<tbody>
						@php
							$no = 1;   
						@endphp
						@if(count($data) == 0)
						<tr>
							<td colspan="5" align="center">Data Tidak Ada</td>
						</tr>
						@else
						@foreach ($data as $dt)
						<tr>
							<td>{{ $no++ }}</td>
							<td>{{ ucwords($dt['acara']) }}</td>
							<td>{{ $dt['tanggal_acara'] }}</td>
							<td>{{ $dt['keterangan'] }}</td>
							<td><a class="btn btn-info" target="_blank" href='/see-qr/{{md5(sha1(md5($dt['qrcode']))) }}'>Lihat QR</a></td>
						</tr>
						@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@endif
</main>
@include('footer')