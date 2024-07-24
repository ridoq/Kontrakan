@extends('layouts.app')

@section('content')
    {{-- Tambah Member --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Anggota</h3>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between py-0 mb-5 " style="height: 40px">
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
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Anggota Baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('members.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 mb-5">
                                            <div class="input-group input-group-merge">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                        class="ri-user-line"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" id="basic-addon11"
                                                        placeholder="Ridoqq" aria-label="Username"
                                                        aria-describedby="basic-addon11" name="name"/>
                                                    <label for="basic-addon11">Nama Lengkap</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6 mb-5">
                                            <div class="input-group input-group-merge">
                                                <span id="basic-icon-default-fullname2"
                                                    class="input-group-text pointer-events-none"><i class="ri-mail-line"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" id="basic-addon13"
                                                        placeholder="ridoq123" aria-label="Recipient's username"
                                                        aria-describedby="basic-addon13" name="email"/>
                                                    <label for="basic-addon13">Email</label>
                                                </div>
                                                <span class="input-group-text">@gmail.com</span>
                                            </div>
                                        </div>

                                        <div class="col-6 mb-5">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i class="ri-phone-line"></i> (+62)</span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="phone-number-mask"
                                                        class="form-control phone-number-mask" placeholder="895422414260" oninput="formatPhoneNumber()" name="phone_number"/>
                                                    <label for="phone-number-mask">Nomor Telepon</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-5">
                                            <div class=" form-password-toggle ">
                                                <div class=" input-group input-group-merge " id="">
                                                    <span id="border-none basic-icon-default-fullname2"
                                                        class="input-group-text"><i class="ri-lock-line"></i></span>
                                                    <div class=" form-floating form-floating-outline">
                                                        @php
                                                            $pw = 'user_' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
                                                        @endphp
                                                        <input type="hidden" name="password" value="{{ $pw }}">
                                                        <input type="password" class="form-control"
                                                            id="basic-default-password12" placeholder="{{ $pw }}"
                                                            aria-describedby="basic-default-password12" disabled />
                                                        <label for="basic-default-password12">Password :
                                                            <strong>{{ $pw }}</strong></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-5">
                                            <div class="input-group input-group-merge ">
                                                <span class="input-group-text "><i class="ri-road-map-line"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <textarea class="form-control h-px5" style="resize: none;height:80px;" name="address" aria-label="With textarea" placeholder="Lorem ipsum"></textarea>
                                                    <label>Alamat</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3 mt-5 d-flex justify-content-end">
                                        <button type="button" class="btn btn-secondary me-2"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
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
                            @php
                                $pageNumber = ($members->currentPage() - 1) * $members->perPage();
                            @endphp
                            @forelse ($members as $index=>$member)
                                <tr>
                                    <td> {{ $pageNumber + $loop->iteration }} </td>
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
                        <tfoot>
                            <tr>
                                <td colspan="9999">
                                    {{ $members->links() }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
