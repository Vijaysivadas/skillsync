@extends("layouts.default")
@section("content")
    <div class=" container">
        <div class="text-center py-9">
            <h2>Our suggested profile that match your requirement</h2>
            <br>
            <div class="card me-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$top_resume->name}}</h5>
                    <p class="">{{$top_resume->email}}</p>
                    <p class="card-text">{{$top_resume->categories}}</p>
                    <p>{{$top_resume->summary}}</p>

                    <a href="{{ asset('storage/' . $top_resume->resume) }}" target="_blank" class="btn btn-primary">View resume</a>
                </div>
            </div>
            <br>
            <h3>Other profiles</h3>
            <br>
            <div class="row p-4">
        @foreach($users as $user)
{{--<div>{{$user}}</div>--}}
<div class="card col-4 me-3" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">{{$user->name}}</h5>
        <p class="">{{$user->email}}</p>

        <p class="card-text">{{$user->categories}}</p>
        <p>{{$user->summary}}</p>

        <a href="{{ asset('storage/' . $user->resume) }}" target="_blank" class="btn btn-primary">View resume</a>
    </div>
</div>
    @endforeach

            </div>
        </div>
    </div>

@endsection
