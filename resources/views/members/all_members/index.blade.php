@extends('layouts.master.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-lg-12 order-2 mb-2 order-md-3 order-lg-2">
                <div class="d-flex justify-content-between">
                    <h4 class="fw-bold py-1"><span class="text-muted text-capitalize fw-light">All members</span></h4>
                    <div>
                        <a class="btn btn-sm btn-outline-primary text-capitalize" type="button"
                            href="{{ route('members.create') }}" aria-haspopup="true" aria-expanded="false">
                            <i class='me-2 bx bx-plus'></i>
                            Add member
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card p-3">
                    @if (count($ordinaryMembers))
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Full Names</th>
                                    <th>Address</th>
                                    <th>Occupation</th>
                                    <th>Identification</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($ordinaryMembers as $member)
                                    <tr>
                                        <td>
                                            {{ $member->surname }}<br/>
                                            {{ $member->given_name }}<br/>
                                            {{ $member->other_name }}
                                        </td>
                                        <td>
                                            {{ $member->address }}<br/>
                                            {{ $member->email }}<br/>
                                            {{ $member->telephone_number }}
                                        </td>
                                        <td>
                                            {{ $member->occupation }}<br/>
                                        </td>
                                        <td>
                                            {{ $member->nin }}<br/>
                                            {{ $member->passport_number }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="mb-0 text-center text-capitalize">No members found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
