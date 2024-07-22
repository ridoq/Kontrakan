@extends('layouts.app')

@section('content')
    {{-- Tambah Member --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Anggota</h3>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between py-0 mb-4">
                    <form action="" method="GET" class="d-flex w-50 me-4">
                        @csrf
                        <div class="d-flex align-items-center border rounded px-3 w-100">
                            <input type="text" name="search" class="form-control border-none"
                                value="{{ request()->input('search') }}" placeholder="Cari data ...">
                            <a class="btn-close cursor-pointer" href="{{ route('members') }}"></a>
                        </div>
                    </form>
                    @hasrole('admin')
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah Data
                    </button>
                    @endhasrole
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Member Baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('members.store') }}">
                                <div class="modal-body">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Nama:</label>
                                        <input type="text" class="form-control" id="recipient-name" name="name">
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"
                                            name="address"></textarea>
                                        <label for="floatingTextarea2">Alamat</label>
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Nomor Telepon:</label>
                                        <input type="number" class="form-control" id="recipient-name" name="phone_number">
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Email:</label>
                                        <input type="text" class="form-control" id="recipient-name" name="email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Password:</label>
                                        <input type="text" class="form-control" id="recipient-name" name="password">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead >
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No Telepon</th>
                                <th>Email</th>
                                @hasrole('admin')
                                <th>Aksi</th>
                                @endhasrole
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">

                            @forelse ($members as $index=>$member)
                            <tr>
                                <th scope="row"> {{ $index + 1 }} </th>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->address }}</td>
                                <td>{{ $member->phone_number }}</td>
                                <td>{{ $member->email }}</td>
                                @hasrole('admin')
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-pencil-line me-2"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-delete-bin-7-line me-2"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                                @endhasrole
                            </tr>
                        @empty
                            <tr>
                                <th class="row">Member Not Found</th>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Anggota</h3>
            </div>
            <div class="card-body">
                @hasrole('admin')
                    <div class="d-flex justify-content-between py-0 mb-4">
                        <form action="" method="GET" class="d-flex w-50 me-4">
                            @csrf
                            <div class="d-flex align-items-center border rounded px-3 w-100">
                                <input type="text" name="search" class="form-control border-none"
                                    value="{{ request()->input('search') }}" placeholder="Cari data ..." >
                                <a class="btn-close cursor-pointer" href="{{ route('members') }}"></a>
                            </div>
                        </form>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Data
                        </button>
                    </div>


                @endhasrole
                {{-- Tambah Member --}}

        {{-- <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Nomor Telepon</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($members as $index=>$member)
                            <tr>
                                <th scope="row"> {{ $index + 1 }} </th>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->address }}</td>
                                <td>{{ $member->phone_number }}</td>
                                <td>{{ $member->email }}</td>
                                <td></td>
                            </tr>
                        @empty
                            <tr>
                                <th class="row">Member Not Found</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div> --}}
    </div>
@endsection
