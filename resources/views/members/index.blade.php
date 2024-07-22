@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $index=>$member)
                <tr>
                    <th scope="row"> {{ $index + 1 }} </th>
                    <td>{{ $member->name }}</td>
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
