@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ __('Profile Information') }}</h2>
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ __('Update Password') }}</h2>
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ __('Delete Account') }}</h2>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
