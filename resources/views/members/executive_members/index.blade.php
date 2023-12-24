@extends('layouts.master.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold py-1"><span class="text-muted text-capitalize fw-light">Membership / </span>({{ count($executiveMembers) }}) Executive members </h5>
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button"
                        href="{{ route('members.create') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-plus'></i>
                        Add member
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card p-3">
                    @if (count($executiveMembers) > 0)
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Identification</th>
                                    <th>Address</th>
                                    <th>Occupation</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($executiveMembers as $member)
                                    <tr>
                                        <td>
                                            <div>
                                                {{ $member->surname }} {{ $member->given_name }} {{ $member->other_name }}
                                            </div>
                                            <div>
                                                {{ $member->nin }}
                                            </div>
                                            <div>
                                                @if($member->passport_number)
                                                    {{ $member->passport_number }}
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{ $member->address }}
                                            </div>
                                            <div>
                                                {{ $member->email }}
                                            </div>
                                            <div>
                                                {{ $member->telephone_number }}
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{ $member->occupation }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="mb-0 text-center text-capitalize">No executive members found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
