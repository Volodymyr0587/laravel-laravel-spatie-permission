<x-posts-layout>

    <a href="{{ route('home') }}" class="inline-flex items-center rounded bg-neutral-100 mb-2 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-neutral-600 shadow-light-3 transition duration-150 ease-in-out hover:bg-neutral-200 hover:shadow-light-2 focus:bg-neutral-200 focus:shadow-light-2 focus:outline-none focus:ring-0 active:bg-neutral-200 active:shadow-light-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">
        <svg class="w-5 h-5 mr-3 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
        </svg>
        <span>Back to posts</span>
    </a>
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
                        <a href="{{ route('admin.users.show', $post->user->id) }}"><b>{{
                                $post->user->name }}</b></a>
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
</x-posts-layout>
