@extends('layouts.base')

@section('title', 'TechControl')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/splash.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
@endsection

@section('content')
<div class="splash">
  <div class="overlay"></div>
  <div class="logo-container">
    <h1 class="logo-text">Tech<span>Control</span></h1>
  </div>
</div>
@endsection

@section('scripts')
<script>
  setTimeout(() => {
    window.location.href = "{{ route('portal') }}";
  }, 2000);
</script>
@endsection
