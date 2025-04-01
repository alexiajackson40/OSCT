@extends('layouts.app')

@section('content')
<div class="page-content">
    <div class="form-container">
        <div class="card">
            <div class="card-body d-flex flex-column">
                <div class="user-form">
                    <form class="needs-validation" novalidate>
                        <!-- all fields remain the same -->
                        <button class="btn btn-primary" type="submit">Submit form</button>
                        <div class="signIn-container">
                            <p>Already have an account? <a id="signIn-btn" class="btn-signIn" href="{{ route('login') }}">Sign In</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
