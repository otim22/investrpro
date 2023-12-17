@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible" role="alert" style="padding: 10px;background-color: #16ac2a;color: white;margin-bottom: 15px;">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible" role="alert" style="padding: 10px;background-color: #d0382d;color: white;margin-bottom: 15px;">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-dismissible" role="alert" style="padding: 10px;background-color: rgb(219, 183, 51);color: white;margin-bottom: 15px;">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-dismissible border" role="alert" style="padding: 10px;background-color: rgb(49, 159, 218);color: white;margin-bottom: 15px;">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert" style="padding: 10px;background-color: #ca3025;color: white;margin-bottom: 15px;">
        <strong>Please check the form below for errors</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif