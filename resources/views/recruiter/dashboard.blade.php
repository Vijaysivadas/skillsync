@extends("layouts.default")
@section("content")
    <div class="d-flex flex-center content-min-h">
        <div class="text-center py-9"><img class="img-fluid mb-7 d-dark-none" src="../assets/img/spot-illustrations/2.png" width="470" alt="" /><img class="img-fluid mb-7 d-light-none" src="../assets/img/spot-illustrations/dark_2.png" width="470" alt="" />
            <h1 class="text-body-secondary fw-normal mb-5">Outline the Characteristics of Your Perfect Hire</h1>
            <form action="{{route('recruiter.requirements')}}" method="post">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{$rec->requirements}}</textarea>
                    @error('description')
                    <span class="invalid-feedback d-block" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <select class="form-select form-select-lg mb-3 mt-3" required name="category" aria-label=".form-select-lg example">
                                        <option selected disabled value="">Select category of skills you looking for</option>
                    @foreach($categories as $category)
                        <option value="{{$category}}">{{$category}}</option>

                    @endforeach

                </select>
                <input class="btn btn-lg btn-primary mt-4" type="submit">

            </form>

        </div>
    </div>
@endsection
