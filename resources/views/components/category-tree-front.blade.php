<div>
    <ul class="list-group">
    @foreach ($categories as $category)
        <li class="list-group-item">
            <a href="{{ route('frontend.articles.category', ['category' => $category->id]) }}">
                {{ $category->name }}
            </a>
        </li>
        @foreach ($category->childrenRecursive as $children)
            <li class="list-group-item">>>
                <a href="{{ route('frontend.articles.category', ['category' => $children->id]) }}">
                    {{ $children->name }}
                </a>
            </li>
        @endforeach
    @endforeach
    </ul>
   <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
</div>
