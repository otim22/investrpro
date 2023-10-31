@extends('layouts.master.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <h4 class="fw-bold py-1"><span class="text-muted fw-light text-capitalize">Member savings / <a href="{{ route('member-savings.index') }}">Monthly premiums</a> / </span>Create</h4>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="d-flex justify-content-start">
                <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('member-savings.create') }}" aria-haspopup="true" aria-expanded="false">
                    Back to Monthly premiums
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 text-capitalize">Premium monthly collection form</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Member</label>
                            <div class="col-sm-10">
                                <select 
                                    id="member" 
                                    class="form-select @error('member') is-invalid @enderror" 
                                    name="member"
                                    aria-label="Default select member"
                                >
                                    <option selected>Select member</option>
                                    <option value="1">Otim</option>
                                    <option value="2">Fredrick</option>
                                    <option value="3">Deere</option>
                                </select>
                                @error('member')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="premium">Premium</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="premium" 
                                    class="form-control @error('premium') is-invalid @enderror" 
                                    name="premium"
                                    value="{{ old('premium') }}"
                                    placeholder="100000" 
                                />
                                @error('premium')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="month">Month</label>
                            <div class="col-sm-10">
                                <select 
                                    id="month" 
                                    class="form-select" 
                                    name="month"
                                    aria-label="Default select month"
                                >
                                    <option selected>Select month</option>
                                    <option value="1">Aug</option>
                                    <option value="2">Sept</option>
                                    <option value="3">Oct</option>
                                </select>
                                @error('month')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="date_paid">Date</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="date"
                                        id="date_paid"
                                        class="form-control"
                                        placeholder="12/03/2029"
                                        aria-label="12/03/2029"
                                        aria-describedby="date_paid"
                                    />
                                    @error('date_paid')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection