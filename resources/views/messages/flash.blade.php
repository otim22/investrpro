@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible" role="alert" style="padding: 10px;background-color: rgb(116, 203, 128);color: white;margin-bottom: 15px;">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible" role="alert" style="padding: 10px;background-color: #bf5851;color: white;margin-bottom: 15px;">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-dismissible" role="alert" style="padding: 10px;background-color: rgb(187, 168, 99);color: white;margin-bottom: 15px;">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-dismissible border" role="alert" style="padding: 10px;background-color: rgb(104, 159, 188);color: white;margin-bottom: 15px;">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert" style="padding: 10px;background-color: #b85048;color: white;margin-bottom: 15px;">
        <strong>Please check the form below for errors</strong>
        <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif