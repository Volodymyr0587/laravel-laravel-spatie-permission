<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center">
            @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @role(['admin', 'writer'])
                <a href="{{ route('admin-writer.postsList') }}" class="font-semibold text-gray-600 hover:text-gray-900">Posts</a>
                @endrole
                @auth
                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 ml-4">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900">Log in</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900">Register</a>
                @endif
                @endauth
            </div>
            @endif

            <div class="max-w-7xl mx-auto p-6 lg:p-8">

                <!-- Container for demo purpose -->
                <div class="container my-24 mx-auto md:px-6">
                    <!-- Section: Design Block -->
                    <section class="mb-32 text-center md:text-left">
                        <h2 class="mb-12 text-center text-3xl font-bold">Post with tag {{ $tag }}</h2>

                        <!-- Posts -->
                        @forelse ($posts as $post)
                        <div class="mb-12 grid items-center gap-x-6 md:grid-cols-2 xl:gap-x-12">
                            <div class="mb-6 md:mb-0">
                                <div class="relative mb-6 overflow-hidden rounded-lg bg-cover bg-no-repeat shadow-lg dark:shadow-black/20"
                                    data-te-ripple-init data-te-ripple-color="light">

                                    <img src="{{ $post->image ? asset('storage/images/posts/'. $post->image) : asset('images/default-post-image.png') }}" class="w-full"
                                        alt="{{ $post->title }}" />
                                    <a href="{{ route('showPost', $post->id) }}">
                                        <div
                                            class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100 bg-[hsla(0,0%,98.4%,.15)]">
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div>
                                <h3 class="mb-3 text-2xl text-blue-900 font-bold hover:underline"><a href="{{ route('showPost', $post->id) }}">{{ $post->title }}</a></h3>
                                <div
                                    class="mb-3 flex items-center justify-center text-sm font-medium text-danger dark:text-danger-500 md:justify-start">
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="mr-2 h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 01-1.161.886l-.143.048a1.107 1.107 0 00-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 01-1.652.928l-.679-.906a1.125 1.125 0 00-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 00-8.862 12.872M12.75 3.031a9 9 0 016.69 14.036m0 0l-.177-.529A2.25 2.25 0 0017.128 15H16.5l-.324-.324a1.453 1.453 0 00-2.328.377l-.036.073a1.586 1.586 0 01-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 01-5.276 3.67m0 0a9 9 0 01-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
                                    </svg> --}}
                                    @foreach ($post->tags as $tag)
                                        <a class="mr-2" href="{{ route('getPostsByTag', $tag->name) }}">
                                            <span class="bg-purple-100 text-purple-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">
                                                {{ $tag->name }}
                                            </span>
                                        </a>
                                    @endforeach

                                </div>
                                <p class="mb-6 text-neutral-500">
                                    <small>Published <u>{{ $post->updated_at->diffForHumans() }}</u> by
                                        {{-- <a href="#!">{{ $post->user->name }}</a>< --}}
                                        @role('admin')
                                        <a href="{{ route('admin.users.show', $post->user->id) }}">{{ $post->user->name }}</a>
                                        @else
                                        {{ $post->user->name }}
                                        @endrole
                                    </small>
                                </p>
                                <p class="text-neutral-500 ">
                                    {{ Str::limit($post->body, 50) }} <a class="font-semibold text-blue-400 underline" href="{{ route('showPost', $post->id) }}">Read more...</a>
                                </p>
                            </div>
                        </div>
                        <!--  Post -->
                        @empty
                        <p class="mb-12 text-center text-3xl font-bold">No Posts</p>
                        @endforelse



                    </section>
                    <!-- Section: Design Block -->
                    {{ $posts->links() }}
                </div>
                <!-- Container for demo purpose -->
            </div>
        </div>
    </body>

</html>
