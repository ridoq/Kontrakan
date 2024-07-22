@extends('layouts.app')

@section('content')
    {{-- Tambah Member --}}
    @hasrole('admin')
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Member</button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Member Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
    @endhasrole
    {{-- Tambah Member --}}

    <table class="table">
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
@endsection
