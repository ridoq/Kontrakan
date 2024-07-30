@section('acc')
    <td>
        <div class="row">
            <form action="{{ route('incomes.accept', $income->id) }}" method="POST" class="col-lg-6 col-sm-12 mt-1" >
                @csrf

                <button type="submit" class="col-12 btn btn-label-primary" type="button">Verify</button>
            </form>
            <form action="{{ route('incomes.reject', $income->id) }}" method="POST" class="col-lg-6 col-sm-12 mt-1">
                @csrf
                <button type="submit" class="col-12 btn btn-label-danger" type="button">Rejects</button>
            </form>
        </div>
    </td>
@endsection
@section('btnEditDelete')
    <td>
        <div class="dropdown d-flex justify-content-center">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                    class="ri-more-line"></i></button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"><i class="ri-pencil-line me-2"></i> Edit</a>
                <a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-7-line me-2"></i> Delete</a>
            </div>
        </div>
    </td>
@endsection
