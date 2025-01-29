@extends ('layout/app')

@section ('style')
	<link rel="stylesheet" href="{{ URL::asset('style/style.css') }}">
@endsection

@section ('script')
	<script src="{{ URL::asset('scripts/script.js') }}" charset="utf-8"></script>
@endsection

@section ('content')
   


<div class="app-wrapper">
    <button class="generate-dog">Generate Dog</button>
    <div id="image-container"></div>
</div>

<select id="breedSelect">
    <option value="">Select Breed</option>
</select>
@endsection