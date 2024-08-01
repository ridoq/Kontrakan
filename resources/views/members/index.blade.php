@extends('layouts.app')

@section('content')
    {{-- Tambah Member --}}
    <div class="col-12">
        <div class="card" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
            <div class="card-header">
                <h3 class="card-title">Daftar Anggota</h3>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between py-0 mb-5 " style="height: 40px">
                    <form action="" method="GET" class="d-flex w-50 me-4">
                        @csrf
                        <div class="d-flex align-items-center border rounded px-3 w-100" data-aos="fade-up"
                            data-aos-duration="1000" data-aos-delay="600">
                            <input type="text" name="search" class="form-control border-none"
                                value="{{ request()->input('search') }}" placeholder="Cari data ...">
                            <a class="btn-close cursor-pointer" href="{{ route('members') }}"></a>
                        </div>
                    </form>
                    @hasrole('admin')
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            data-aos="fade-up" data-aos-duration="1000" data-aos-delay="700">
                            Tambah Data
                        </button>
                    @endhasrole
                </div>

                <div class="table-responsive text-nowrap" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="900">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Photo</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No Telepon</th>
                                <th>Email</th>
                                @hasrole('admin')
                                    <th>Default Password</th>
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
                                    <td>
                                        
                                        <img src="{{ asset('storage/' . $member->photo_profile) }}" alt=""
                                            style="width: 100px; height:100px;">
                                    </td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->address }}</td>
                                    <td>{{ $member->phone_number }}</td>
                                    <td>{{ $member->email }}</td>
                                    @hasrole('admin')
                                        <td>{{ $member->pw }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                                <div class="dropdown-menu">
                                                    {{-- Edit Button --}}
                                                    <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $member->id }}"><i
                                                            class="ri-pencil-line me-2"></i>
                                                        Edit</button>
                                                    {{-- Edit Button --}}
                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                            class="ri-delete-bin-7-line me-2"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    @endhasrole
                                </tr>
                                <!-- Modal Edit -->

                                <!-- End Modal Edit -->
                            @empty
                                <tr>
                                    <th class="row">Anggota tidak ditemukan</th>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Anggota Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('members.store') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-5">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="ri-user-line"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="basic-addon11"
                                            placeholder="Example: Jhon Doe" aria-label="Username"
                                            aria-describedby="basic-addon11" name="name" />
                                        <label for="basic-addon11">Nama Lengkap</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 mb-5">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text pointer-events-none"><i
                                            class="ri-mail-line"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="basic-addon13"
                                            placeholder="example@gmail.com" aria-label="Recipient's username"
                                            aria-describedby="basic-addon13" name="email" />
                                        <label for="basic-addon13">Email</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 mb-5">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="ri-phone-line"></i> (+62)</span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" id="phone-number-mask"
                                            class="form-control phone-number-mask" placeholder="8123456789"
                                            name="phone_number" />
                                        <label for="phone-number-mask">Nomor Telepon</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-5">
                                <div class=" form-password-toggle ">
                                    <div class=" input-group input-group-merge " id="">
                                        <span id="border-none basic-icon-default-fullname2" class="input-group-text"><i
                                                class="ri-lock-line"></i></span>
                                        <div class=" form-floating form-floating-outline">
                                            @php
                                                $pw = 'user_' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
                                            @endphp
                                            <input type="hidden" name="password" value="{{ $pw }}">
                                            <input type="password" class="form-control" id="basic-default-password12"
                                                placeholder="{{ $pw }}"
                                                aria-describedby="basic-default-password12" disabled />
                                            <label for="basic-default-password12">Password :
                                                <strong>{{ $pw }}</strong></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-5 mt-3">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="file" class="form-control" id="basic-addon11"
                                            name="photo_profile" />
                                        <label for="basic-addon11">Photo Profile</label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 mb-5">
                                <div class="input-group input-group-merge ">
                                    <span class="input-group-text "><i class="ri-road-map-line"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control h-px5" style="resize: none;height:80px;" name="address" aria-label="With textarea"
                                            placeholder="Lorem ipsum"></textarea>
                                        <label>Alamat</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-3 mt-5 d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @foreach ($members as $member)
        <div class="modal fade" id="editModal{{ $member->id }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $member->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $member->id }}">Edit data
                            '{{ $member->name }}'</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('members.update', $member->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12 mb-5">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="ri-user-line"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="basic-addon11"
                                                placeholder="Example: Jhon Doe" aria-label="Username"
                                                aria-describedby="basic-addon11" name="name"
                                                value="{{ $member->name }}" />
                                            <label for="basic-addon11">Nama Lengkap</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 mb-5">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2"
                                            class="input-group-text pointer-events-none"><i
                                                class="ri-mail-line"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="basic-addon13"
                                                placeholder="example" aria-label="Recipient's username"
                                                aria-describedby="basic-addon13" name="email"
                                                value="{{ $member->email }}" />
                                            <label for="basic-addon13">Email</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 mb-5">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="ri-phone-line"></i> (+62)</span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="phone-number-mask"
                                                class="form-control phone-number-mask" placeholder="8123456789"
                                                name="phone_number" value="{{ $member->phone_number }}" />
                                            <label for="phone-number-mask">Nomor Telepon</label>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-12 mb-5">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2"
                                        class="input-group-text"><i
                                            class="ri-user-line"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control"
                                            id="basic-addon11" placeholder="********"
                                            aria-label="Username"
                                            aria-describedby="basic-addon11" name="password"
                                            autocomplete="new-password"
                                            value="{{ $member->password }}" />
                                        <label for="basic-addon11">Password: </label>
                                    </div>
                                </div>
                            </div> --}}
                                <div class="col-12 mb-5 mt-3">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input type="file" class="form-control" id="basic-addon11"
                                                name="photo_profile" value="{{ $member->profile_photo }}" />
                                            <label for="basic-addon11">Photo Profile</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-5">
                                    <div class="input-group input-group-merge ">
                                        <span class="input-group-text "><i class="ri-road-map-line"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <textarea class="form-control h-px5" style="resize: none;height:80px;" name="address" aria-label="With textarea"
                                                placeholder="Lorem ipsum">{{ $member->address }}</textarea>
                                            <label>Alamat</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-3 mt-5 d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary me-2"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
