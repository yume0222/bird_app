<x-app-layout>
    {{--<x-slot name="header">-->
    <!--    <h2 class="font-semibold text-xl text-gray-800 leading-tight">-->
    <!--        {{ __('Profile') }}-->
    <!--    </h2>-->
    <!--</x-slot>--}}
    <style>
        .posts {
            padding: 16px 0;
            margin: 0 auto;
            width: calc(100% - 32px);
        }
        .mb {
            margin-bottom: 56px;
        }
        @media screen and (min-width: 768px) {
            .mb {
                margin-bottom: 0;
            }
        }
    </style>
    
    <div class="header">
        <div>
            <a href="/">
                <img src="{{ asset('/img/arrow_back.png') }}" class="back">
            </a>
        </div>
        <h1>Profile</h1>
    </div>
    <div class="mb">
    <div class="posts">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
    
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
    
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <div class="sp_button">
        <x-post-button />
    </div>
</x-app-layout>
