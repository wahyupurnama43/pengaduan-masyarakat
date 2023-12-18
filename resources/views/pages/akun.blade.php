@extends('layouts.master')

@section('content')
    <x-info-card />


    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center align-content-center">
                    <h6>Data User</h6>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah User</button>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Email</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Role</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $user->nama }}</h6>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $user->email }}</h6>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <span
                                                        class=" badge badge-sm bg-gradient-{{ ($user->role == 'admin' ? 'success' : $user->role == 'petugas') ? 'info' : 'warning' }}"">{{ $user->role }}
                                                        </h6>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="d-flex gap-2">
                                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $user->id }}" type="button">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modalEdit{{ $user->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <form role="form" action="{{ route('dashboard.updateUser', $user->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit {{ $user->nama }}
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <input type="text" class="form-control"
                                                                        name="nama" placeholder="Nama" aria-label="Nama"
                                                                        value="{{ $user->nama }}">
                                                                    @error('nama')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <input type="email" class="form-control"
                                                                        name="email" placeholder="Email"
                                                                        aria-label="Email"  value="{{ $user->email }}">
                                                                    @error('email')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <input type="password" class="form-control"
                                                                        name="password" placeholder="Password"
                                                                        aria-label="Password">
                                                                    @error('password')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                        
                                                                <div class="mb-3">
                                                                    <select name="role" id=""
                                                                        class="form-control">
                                                                        <option value="masyarakat" {{ $user->role == 'masyarakat' ? 'selected' : '' }}>Masyarakat</option>
                                                                        <option value="petugas"  {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                                                        <option value="admin"  {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                                    </select>
                                                                    @error('role')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="text-center">
                                                                    <button type="submit"
                                                                        class="btn bg-gradient-dark w-100 my-4 mb-2">Ubah</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('dashboard.deteleUser', $user->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button  class="btn btn-danger" type="submit"><i class="fa-solid fa-trash-can"></i></button>
                                            </form>
                                        </td>

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
                <form role="form" action="{{ route('dashboard.storeUser') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="nama" placeholder="Nama"
                                aria-label="Nama">
                            @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email"
                                aria-label="Email">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password"
                                aria-label="Password">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Konfirmasi Password" aria-label="Konfirmasi Password">
                            @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <select name="role" id="" class="form-control">
                                <option value="masyarakat">Masyarakat</option>
                                <option value="petugas">Petugas</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('role')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Daftar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
