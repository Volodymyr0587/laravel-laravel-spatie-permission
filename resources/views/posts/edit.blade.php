<x-app-layout>

    <div class="container mt-8 mx-auto md:px-6 bg-gray-100">

        <!-- Section: Design Block -->
        <section class="mb-16 text-center">
            <h2 class="mb-12 pb-4 text-center text-3xl font-bold">Edit Post
            </h2>

            <!-- component -->
            <form action="{{ route('admin-writer.postUpdate', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="min-h-screen md:px-20 pt-6">
                    <div class=" bg-white rounded-md px-6 py-10 max-w-2xl mx-auto">
                        <div class="space-y-4">
                            <div>
                                <label for="title" class="text-lx font-serif">Title:</label>
                                <input type="text" name="title" value="{{ $post->title }}" id="title"
                                    class="w-full outline-none py-1 px-2 text-md border-1 rounded-md" />
                            </div>
                            <div>
                                <label for="body" class="block mb-2 text-lg font-serif">Content:</label>
                                <textarea id="body" name="body" cols="30" rows="10" placeholder="whrite here.."
                                    class="w-full font-serif  p-4 text-gray-600 outline-none rounded-md">{{ $post->body }}</textarea>
                            </div>

                            <div>
                                <label for="tags" class="block mb-2 text-lg font-serif">Tags (separated by whitespace):</label>
                                <input type="text" name="tags" placeholder="tag1 tag2 tag3 ..." id="tags" value="{{ $post->tags->pluck('name')->join(" ") }}"
                                    class="w-full outline-none py-1 px-2 text-md border-1 rounded-md" />
                            </div>

                            <div>
                                <label for="image" class="text-lx font-serif">Image:</label>
                                <input type="file" name="image" id="image"
                                    class="w-full outline-none py-1 px-2 text-md border-1 rounded-md" />
                            </div>

                            @role('admin')
                            <div>
                                <label for="is_active" class="text-lx font-serif">Published:</label>
                                <input type="checkbox" name="is_active" id="is_active" @checked(old('is_active', $post->is_active))
                                    class="py-1 px-2" />
                            </div>
                            @endrole


                            <button
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">UPDATE
                                POST</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <!-- Section: Design Block -->
    </div>
    <div class="m-4">
        FOOOTER
    </div>
</x-app-layout>
