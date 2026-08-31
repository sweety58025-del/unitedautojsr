@extends('backend.partial.master')
@section('title', 'Dashboard')
@section('backend-content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header pb-0">
                <h4>Welcome Back, {{ $user->name }} 👋</h4>
                <span>
                    Manage your dashboard, monitor activities, and stay updated with everything in one place.
                </span>
            </div>

            <div class="card-body">
                <p class="mb-0">
                    "Welcome to your dashboard! Here you can manage your work efficiently, track progress, and access all important features quickly and easily. Wishing you a productive and successful day ahead."
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
