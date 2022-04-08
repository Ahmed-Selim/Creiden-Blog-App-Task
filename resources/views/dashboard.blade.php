<x-app-layout>
    <x-slot name="header">
        <span class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog Posts') }}
        </span>
        @if (Auth::user()->privilege == 'Author')
            <a class="btn btn-outline-primary" href="{{ route('createPostPage') }}"> + New Post</a>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- You're logged in! --}}
                    {{-- @include('blog-posts/list-blog-post') --}}
                    
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        @foreach ($blogPosts as $post)    
                            <div class="col card-group" id="post-{{ $post->id }}">
                                <div class="card">
                                    <div class="card-body">
                                        <div>
                                            <div class="d-flex justify-between">
                                                <span class="h5 card-title d-block">{{ $post->title }}</span>
                                                @if (Auth::user()->privilege == 'Author')    
                                                    <div>
                                                        <form action="{{route('deletePost', $post)}}" method="POST">
                                                            @method('DELETE')  @csrf
                                                            <button type="submit" class="btn-close"></button>
                                                        </form>
                                                        <form action="{{route('updatePostPage', $post)}}" method="GET">
                                                            @csrf
                                                            <button type="submit btn-outline-primary" class="">Edit</button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                            <span class="text-muted">{{ $post->created_at }}</span>
                                        </div>
                                        <hr class="mx-auto w-75">
                                        <p class="card-text"> {{ $post->body }} </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
