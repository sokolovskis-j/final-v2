
<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
            <div class="p-6">
                <div class="mb-4">
                    <h2>Add New Blog</h2>
                </div>
                <div class="mb-4">
                <form action="{{ route('blog.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="image">Upload Image:</label>
                    <br>
                        <input type="file" name="image" id="image">
                    </div>
                    <div class="mb-4">
                        <label for="blog_name">Blog Name:</label>
                        <br>
                        <input class="w-full" type="text" name="blog_name" id="blog_name">
                    </div>
                    <div class="mb-4 w-full">
                        <label for="main_text">Main Text:</label>
                        <br>
                        <textarea class="w-full" name="main_text" id="main_text" rows="4"></textarea>
                    </div>
                    <div class="mb-4">
                        <button type="submit" name="publish" value="0" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save as Draft</button>
                    </div>
                    <div class="mb-4">
                        <button type="submit" name="publish" value="1" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save and Publish</button>
                    </div>
                </form>
    </div>
</x-app-layout>
