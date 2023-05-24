<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div id="fade-out" class="py-5 text-center">
        <div class="max-w-7xl mx-auto sm:px-6">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __("You're logged in!") }}
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="bg-green-200 p-4 mb-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add New Blog Button -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-14 p-6 text-center">
            <a href="{{ route('blog.add') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Blog
            </a>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4 pb-20">
            <h2 class="text-lg font-semibold mt-6 p-6 text-gray-900 dark:text-gray-100">Your creatives</h2>

            @if ($blogs && $blogs->count() > 0)
            <ul class="space-y-4">
                @foreach($blogs as $blog)
                    <li class="flex items-center space-x-4 border border-gray-300 rounded-lg p-4">
                        <div class="w-1/6">
                            <img src="{{ asset($blog->image) }}" alt="Blog Image" class="w-full h-auto">
                        </div>
                        <div class="w-1/6 p-5">
                            <h4 class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 mb-10">
                                {{ Str::limit($blog->blog_name, 20) }}
                                @if (!$blog->published)
                                    <span class="text-red-500"> (Draft)</span>
                                @endif
                            </h4>
                        </div>
                        <div class="w-2/6 p-5">
                            <p class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 mb-10">
                                {{ Str::limit($blog->main_text, 20) }}
                            </p>
                        </div>
                        <div class="w-1/6">
                            <p class="text-sm text-gray-500">{{ $blog->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="w-1/6">
                            <a href="{{ route('blog.edit', $blog) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                        </div>
                        <div class="w-1/6">
                            <form class="inline-block" action="{{ route('blog.delete', [$blog, 'edit']) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
                <p class="p-6 text-gray-900 dark:text-gray-100">No blog posts yet.</p>
            @endif
        </div>
    </div>

    <!-- Fade out effect for "You're logged in!" message -->
    {{-- MIGHT CONVERT THIS TO CSS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loggedInMessage = document.querySelector('#fade-out');
            setTimeout(function () {
                loggedInMessage.style.opacity = '0';
            }, 5000);
        });
    </script>
</x-app-layout>
