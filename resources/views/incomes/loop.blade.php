@section('acc')
    <td>
        <div class="row">
            <form action="{{ route('incomes.accept', $income->id) }}" method="POST" class="col-lg-6 col-sm-6 mt-1">
                @csrf

                <button type="submit" class="col-12 btn btn-success" type="button"><i class="ri-check-line"></i></button>
            </form>
            <form action="{{ route('incomes.reject', $income->id) }}" method="POST" class="col-lg-6 col-sm-6 mt-1">
                @csrf
                <button type="submit" class="col-12 btn btn-danger" type="button"><i class="ri-close-line"></i></button>
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
                <a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-7-line me-2"></i> Delete</a>
            </div>
        </div>
    </td>
@endsection
@section('btnCancel')
    <td>
        <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                    class="ri-more-2-line"></i></button>
            <div class="dropdown-menu">
                <form action="{{ route('incomes.cancel', $income->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item"><i class="ri-close-line me-2"></i>Cancel</button>
                </form>
            </div>
        </div>
    </td>
@endsection
