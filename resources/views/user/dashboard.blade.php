@extends("layouts.default")
@section("content")
    <div class=" flex-center container content-max-h">
{{--        <div class="text-center py-9"><img class="img-fluid mb-7 d-dark-none" src="../assets/img/spot-illustrations/2.png" width="470" alt="" /><img class="img-fluid mb-7 d-light-none" src="../assets/img/spot-illustrations/dark_2.png" width="470" alt="" />--}}
{{--            <h1 class="text-body-secondary fw-normal mb-5">Create Something Beautiful.</h1><a class="btn btn-lg btn-primary" href="../documentation/getting-started.html">Getting Started</a>--}}
        <div class="row">

            <div class="col-6 text-center"><img width="30%" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTqafzhnwwYzuOTjTlaYMeQ7hxQLy_Wq8dnQg&s"></div>
            <div class="col-6">
                <h3>{{auth()->user()->name}}</h3>
                <p><b>{{auth()->user()->email}}</b></p>
                <form action="{{route('user.profileSetup')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input class="form-control form-control-lg " name="category" value="{{$user->categories}}" type="text" placeholder="Enter skills category seperated by comma" aria-label=".form-control-lg example">
@if($user->resume)
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload Your Resume</label>
                            <p>Resume aldready uploaded.<img width="10%" class="ps-3" src="{{asset('/assets/template/img/icons/success-check.svg')}}"></p>
                            <a href="{{ asset('storage/' . $user->resume) }}" target="_blank">View PDF</a>

                            <input class="form-control" name="resume" type="file" value="{{$user->resume}}" accept="application/pdf" id="formFile">
                        </div>
                        <input class="btn btn-primary mt-3" value="Update" type="submit">
                    @else
                        <div class="mb-3">
                        <label for="formFile" class="form-label">Upload Your Resume</label>

                        <input class="form-control" name="resume" type="file" value="{{$user->resume}}" accept="application/pdf" id="formFile">

                        </div>
                        <input class="btn btn-primary mt-3" value="Submit" type="submit">

                    @endif
                </form>
                @if($errors->any())
                    <div class="col-12 mt-4">
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">{{$error}}</div>
                        @endforeach
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success mt-4">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
        </div>
        </div>
    </div>
@endsection
