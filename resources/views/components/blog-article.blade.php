<article class="flex flex-col shadow my-4">
    <!-- Article Image -->
    <a href="/{{ $article->slug }}" class="hover:opacity-75">
        <img
            src="{{ str_contains($article->thumbnail, 'https') ? "$article->thumbnail" : "/storage/$article->thumbnail " }}" />
    </a>
    <div class="bg-white flex flex-col justify-start p-6">
        <div class="flex flex-row">
            @foreach ($article->categories as $category)
                <a href="/{{ $category->title }}"
                    class="text-blue-700 text-sm font-bold uppercase pb-4 ml-2">{{ $category->title }}</a>
            @endforeach

        </div>

        <a href="/{{ $article->slug }}" class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $article->title }}</a>
        <p href="#" class="text-sm pb-3">
            By <a href="#" class="font-semibold hover:text-gray-800">{{ $article->user->name }}</a>, Published on
            <span class="bold italic">
                {{ $article->getFormattedDate() }}
            </span>
        </p>
        <a href="/{{ $article->slug }}" class="pb-6">{{ $article->shortBody() }}</a>
        <a href="/{{ $article->slug }}" class="uppercase text-gray-800 hover:text-black">Continue Reading <i
                class="fas fa-arrow-right"></i></a>
    </div>
</article>
