<x-guest-layout>
        <x-auth-card>
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('updatePost', $blogPost) }}">
                @csrf
                @method('PUT') 

                <legend style="font-size: x-large;text-align: center;">Update Blog Post</legend>
    
                <!-- Title -->
                <div>
                    <x-label for="title" :value="__('Title')" />
    
                    <x-input id="title" class="block mt-1 w-full" type="text" 
                        name="title" :value="old('title',$blogPost->title)" required autofocus />
                </div>
    
                <!-- Post Body -->
                <div class="mt-4">
                    <x-label for="body" :value="__('Post Body')" />
    
                    <x-textarea id="body" class="block mt-1 w-full" rows="5"
                        type="body" name="body" :value="old('body',$blogPost->body)" required />
                </div>
    
                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4" type="submit">
                        {{ __('Edit') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>
    