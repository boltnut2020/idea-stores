<div>
    <ul class="list-group">
    @foreach ($categories as $category)
        <li class="list-group-item">
            {{ $category->name }}
            <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                    {{ in_array("web",[],true) ? 'checked="checked"' : ''}}>
        </li>
    	@foreach ($category->childrenRecursive as $children)
            <li class="list-group-item">>>
                {{ $children->name }}
                <input type="checkbox" name="categories[]" value="{{ $children->id }}" 
                    {{ in_array("web",[],true) ? 'checked="checked"' : ''}}>
            </li>
        @endforeach
    @endforeach
    </ul>
   <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
</div>
