@section('btnStore')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Bayar Kas
    </button>
@endsection
@section('modalStore')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bayar Kas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form action="{{ route('incomes.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @hasrole('member')
                                <div class="col-12 mb-5 mt-3">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline ">
                                            <input type="hidden" name="hutang" value="{{ $outstandingPayment }}">
                                            <input type="hidden" class="form-control" id="basic-addon11"
                                                placeholder="Example: Jhon Doe" aria-label="Username"
                                                aria-describedby="basic-addon11" name="user_id"
                                                value="{{ Auth::user()->id }}" />
                                            <input type="text" class=" form-control " style="color: rgb(45, 45, 45)"
                                                id="basic-addon11" placeholder="Example: Jhon Doe" aria-label="Username"
                                                aria-describedby="basic-addon11" value="{{ Auth::user()->name }}" disabled />
                                            <label for="basic-addon11">Nama Pembayar:</label>
                                        </div>
                                    </div>
                                </div>
                            @endhasrole
                            @hasrole('admin')
                                <div class="col-12 mb-5 mt-3">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <select name="user_id" class="form-select">
                                                <option hidden>Pilih Member</option>
                                                @forelse ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @empty
                                                    <option>Tidak ada member</option>
                                                @endforelse
                                            </select>
                                            <label for="basic-addon11">Nama Pembayar:</label>
                                        </div>
                                    </div>
                                </div>
                            @endhasrole
                            <div class="col-12 mb-5 mt-3">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="file" class="form-control" id="basic-addon11"
                                            name="payment_proof" />
                                        <label for="basic-addon11">Bukti Pembayaran</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-5 mt-3">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <select name="amount" id="" class="form-select">
                                            <option value="15000" selected>Rp. 15,000</option>
                                            <option value="30000">Rp. 30,000</option>
                                            <option value="45000">Rp. 45,000</option>
                                            <option value="60000">Rp. 60,000</option>
                                            <option value="75000">Rp. 75,000</option>
                                            <option value="90000">Rp. 90,000</option>
                                            <option value="105000">Rp. 105,000</option>
                                        </select>
                                        <label for="basic-addon11">Total bayar</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-5 mt-3">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" name="income_date"
                                            value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control">
                                        <label for="basic-addon11">Tanggal Pembayaran</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-5 mt-3">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <textarea name="description" class="form-control" style="resize: none;height: 150px;" id=""
                                            placeholder="Masukkan Deskripsi pembayaran"></textarea>
                                        <label for="basic-addon11">Deskripsi (Opsional)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-5 d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
