@extends('layouts.master')

@section('content')
    <x-info-card />


    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center align-content-center">
                    <h6>Data Pengaduan</h6>
                    @if (in_array(Auth()->user()->role, ['petugas','masyarakat']))
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah Pengaduan</button>
                    @endif
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Pelapor</th>
                                    <th class = "text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Aduan
                                    </th>

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Lokasi</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Instansi Tujuan</th>

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal Pengaduan</th>
                                    
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Gambar Pengaduan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Petugas </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengaduan as $aduan)
                                    <tr>

                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $aduan->user->nama }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $aduan->user->email }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td width="100%">
                                            <p class="text-xs font-weight-bold mb-0 text-wrap">{{ $aduan->aduan }}</p>
                                        </td>

                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $aduan->lokasi }}</span>
                                        </td>

                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $aduan->intansi_tujuan }}</span>
                                        </td>

                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ date('d M Y',strtotime($aduan->tgl_aduan)) }}</span>
                                        </td>

                                        <td class="align-middle text-center">
                                            <a href="{{ asset('images/'.$aduan->gambar_aduan) }}" target="_blank">
                                                <img src="{{ asset('images/'.$aduan->gambar_aduan) }}" width="60px" alt="">
                                            </a>
                                        </td>

                                        <td class="align-middle text-center text-sm">
                                            @php
                                                $status = [];
                                                $statusBadge = '';
                                                $statusText = '';
                                            @endphp
                                            @foreach ($aduan->tanggapan as $tanggapan)
                                                @php
                                                    if ($tanggapan->status_tanggapan == 'terima') {
                                                        $status[] = 'success';
                                                    } else {
                                                        $status[] = 'danger';
                                                    }
                                                @endphp
                                                <span
                                                    class="badge badge-sm cursor-pointer bg-gradient-{{ $tanggapan->status_tanggapan == 'terima' ? 'success' : 'danger' }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalPetugas{{ $tanggapan->id }}">
                                                    {{ $tanggapan->user->nama }}
                                                </span>
                                                <div class="modal fade" id="modalPetugas{{ $tanggapan->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-wrap" id="exampleModalLabel">
                                                                    {{ Str::limit($aduan->aduan, 50, '...') }}
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <select name="status_tanggapan" id=""
                                                                        class="form-control" readonly disabled>
                                                                        <option value="ditolak"
                                                                            {{ !is_null($tanggapan) && $tanggapan->status_tanggapan == 'ditolak' ? 'selected' : '' }}>
                                                                            Di Tolak</option>
                                                                        <option value="terima"
                                                                            {{ !is_null($tanggapan) && $tanggapan->status_tanggapan == 'terima' ? 'selected' : '' }}>
                                                                            Terima</option>
                                                                    </select>
                                                                    @error('status_tanggapan')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3">
                                                                    <textarea name="tanggapan" class="form-control" id="" cols="30" rows="10" readonly disabled>{{ !is_null($tanggapan) ? $tanggapan->tanggapan : '' }}</textarea>
                                                                    @error('tanggapan')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                            @endforeach
                                        </td>

                                        @if (in_array('danger', $status))
                                            @php
                                                $statusBadge = 'danger';
                                                $statusText = 'Di Tolak';
                                            @endphp
                                        @elseif(in_array('success', $status))
                                            @php
                                                $statusBadge = 'success';
                                                $statusText = 'Terima';
                                            @endphp
                                        @else
                                            @php
                                                $statusBadge = 'warning';
                                                $statusText = 'Proses';
                                            @endphp
                                        @endif

                                        <td class="align-middle text-center">
                                            <span class="badge badge-sm bg-gradient-{{ $statusBadge }}">
                                                {{ $statusText }}
                                            </span>
                                        </td>

                                        @if (in_array(Auth()->user()->role, ['petugas']))
                                            @php
                                                $tanggapan = App\Models\Tanggapan::where(['pengaduan_id' => $aduan->id, 'user_id' => Auth::id()])->first();
                                            @endphp
                                            <td>
                                                <button class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#modalVerif{{ $aduan->id }}" type="button">
                                                    <i class="fa-solid fa-person-chalkboard"></i>
                                                </button>
                                                <div class="modal fade" id="modalVerif{{ $aduan->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <form role="form"
                                                                action="{{ route('tanggapan.store', $aduan->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <select name="status_tanggapan" id=""
                                                                            class="form-control">
                                                                            <option value="ditolak"
                                                                                {{ !is_null($tanggapan) && $tanggapan->status_tanggapan == 'ditolak' ? 'selected' : '' }}>
                                                                                Di Tolak</option>
                                                                            <option value="terima"
                                                                                {{ !is_null($tanggapan) && $tanggapan->status_tanggapan == 'terima' ? 'selected' : '' }}>
                                                                                Terima</option>
                                                                        </select>
                                                                        @error('status_tanggapan')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <textarea name="tanggapan" class="form-control" id="" cols="30" rows="10">{{ !is_null($tanggapan) ? $tanggapan->tanggapan : '' }}</textarea>
                                                                        @error('tanggapan')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>


                                                                    <div class="text-center">
                                                                        <button type="submit"
                                                                            class="btn bg-gradient-dark w-100 my-4 mb-2">Update
                                                                            Aduan</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('pengaduan.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Aduan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-control-label" for="basic-url">Tujuan Aduan</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tujuan Aduan"
                                    name="tujuan_aduan" aria-label="Tujuan Aduan" aria-describedby="basic-addon1"
                                    required>
                            </div>
                            @error('tujuan_aduan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="basic-url">Tanggal Aduan</label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="tgl_aduan" aria-label="Tujuan Aduan"
                                    aria-describedby="basic-addon1" required>
                            </div>

                            @error('tgl_aduan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="basic-url">Lokasi Masalah</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Lokasi Masalah" name="lokasi"
                                    aria-label="Lokasi Masalah" aria-describedby="basic-addon1" required>
                            </div>

                            @error('lokasi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="basic-url">Foto/Gambar Aduan</label>
                            <div class="input-group">
                                <input type="file" class="form-control" name="gambar_aduan" aria-label="Tujuan Aduan"
                                    aria-describedby="basic-addon1" required>
                            </div>

                            @error('gambar_aduan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="basic-url">Aduan</label>
                            <div class="input-group">
                                <textarea name="aduan" class="form-control" id="" cols="30" rows="10" required></textarea>
                            </div>

                            @error('aduan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
