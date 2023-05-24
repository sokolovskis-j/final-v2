<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Blog') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
            <div class="p-6">
                <form action="{{ route('blog.update', $blog) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    
                    <div class="mb-4">
                        <img src="{{ asset($blog->image) }}" alt="Blog Image" width="200">
                    </div>
                    
                    
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">
                            Update Image:
                        </label>
                        <input type="file" name="image" id="image" class="form-input rounded-md shadow-sm">
                    </div>
                    
                    
                    <div class="mb-4">
                        <label for="blog_name" class="block text-gray-700 text-sm font-bold mb-2 ">
                            Blog Name:
                        </label>
                        <input type="text" name="blog_name" id="blog_name" class="form-input rounded-md shadow-sm w-full" value="{{ $blog->blog_name }}" required>
                    </div>
                    
                    
                    <div class="mb-4">
                        <label for="main_text" class="block text-gray-700 text-sm font-bold mb-2">
                            Main Text:
                        </label>
                        <textarea name="main_text" id="main_text" rows="8" class="form-textarea rounded-md shadow-sm h-48 w-full" required>{{ $blog->main_text }}</textarea>
                    </div>
                    

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" name="publish">
                            Save Draft
                        </button>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" name="publish" value="1">
                            Save and Publish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
