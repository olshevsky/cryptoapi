<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tokens') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    @if ($token)
                        {{ __("Your API access token: ") }} {{ $token }}
                    @else
                        <form action="{{ route('create-token') }}" method="POST">
                            {{ __("Your API access token: ") }}
                            <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                                {{ __("Generate token") }}
                            </button>
                            {{ csrf_field() }}
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
