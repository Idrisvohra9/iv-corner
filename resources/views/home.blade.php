<x-layout>
    <section class="w-full md:w-2/3 flex flex-col items-center px-3">
        @foreach ($blogs as $article)
            <x-blog-article :article="$article"></x-blog-article>
        @endforeach

        <!-- Pagination -->
        {{ $blogs->links() }}


    </section>
</x-layout>
