<x-app-layout>
    {{-- Success message --}}
    <x-flash-message />

    <!-- Container for demo purpose -->
<div class="container my-24 mx-auto md:px-6">
    <div class="mb-8 ml-2">
        <a href="{{ route('home') }}"
        class="text-blue-500 hover:underline hover:font-bold transition delay-500 duration-300">Back to all posts</a>
    </div>
    <!-- Section: Design Block -->
    <section class="mb-32">
      <div class="flex flex-wrap">
        <div class="w-full shrink-0 grow-0 basis-auto md:w-2/12 lg:w-3/12">
          <img src="{{ $post->image ? asset('storage/images/posts/'. $post->image) : asset('images/default-post-image.png') }}"
            class="mb-6 w-full rounded-lg shadow-lg dark:shadow-black/20" alt="Avatar" />
        </div>

        <div class="w-full shrink-0 grow-0 basis-auto text-center md:w-10/12 md:pl-6 md:text-left lg:w-9/12">
          <h5 class="mb-6 text-xl font-semibold">{{ $post->title }}</h5>
          <ul class="list-inside mb-6 flex justify-center space-x-4 md:justify-start">
            <p>
                Published at <u>{{ $post->updated_at }}</u> by
                @role('admin')
                <a href="{{ route('admin.users.show', $post->user->id) }}"><b>{{ $post->user->name }}</b></a>
                @else
                {{ $post->user->name }}
                @endrole
            </p>
          </ul>
          <p class="text-justify">
            {{ $post->body }}
          </p>
        </div>
      </div>
    </section>
    <!-- Section: Design Block -->
  </div>

</x-app-layout>
