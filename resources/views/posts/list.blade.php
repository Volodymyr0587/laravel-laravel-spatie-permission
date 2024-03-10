<x-app-layout>
    {{-- Success message --}}
    <x-flash-message />

    <div class="container my-24 mx-auto md:px-6">

        <!-- Section: Design Block -->
        <section class="mb-32 text-center">
            <h2 class="mb-12 pb-4 text-center text-3xl font-bold">Posts
            </h2>
            <div class="mb-8">
                @can('create-post')
                <a href="{{ route('admin-writer.postCreate') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create
                    New Post</a>
                @endcan
            </div>
            <div class="grid gap-6 lg:grid-cols-3 xl:gap-x-12">
                @forelse ($posts as $post)
                <div class="mb-6 lg:mb-0">
                    <div
                        class="relative block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]">
                        <div class="p-6">
                            <h5 class="mb-3 text-lg font-bold">{{ $post->title }}</h5>
                            <p class="mb-4 text-neutral-500">
                                <small>Published <u>{{ $post->updated_at }}</u> by
                                    @role('admin')
                                    <a href="{{ route('admin.users.show', $post->user->id) }}">{{ $post->user->name
                                        }}</a>
                                    @else
                                    {{ $post->user->name }}
                                    @endrole
                                </small>

                            </p>
                            <p class="mb-4 pb-2">
                                {{ Str::limit($post->body, 50) }}
                            </p>
                            @if (auth()->user()->id === $post->user->id || auth()->user()->hasRole('admin'))
                            <a href="{{ route('admin-writer.postEdit', $post->id) }}" data-te-ripple-init data-te-ripple-color="light"
                                class="inline-block rounded-full bg-primary px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-blue-500 shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]">Edit
                            </a>
                                @if (auth()->user()->hasRole('admin'))
                                <form action="{{ route('admin-writer.postDestroy', $post->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure?');"
                                    class="inline-block rounded-full bg-primary px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-red-500 shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">DELETE</button>
                                </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div>
                    No posts yet.
                </div>
                @endforelse
            </div>
            <div class="mt-2 mb-4">
                {{ $posts->links() }}
            </div>
        </section>
        <!-- Section: Design Block -->
    </div>
    {{-- <div class="m-4">
        FOOOTER
    </div> --}}
</x-app-layout>
