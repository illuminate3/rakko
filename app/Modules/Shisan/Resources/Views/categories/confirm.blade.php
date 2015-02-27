{{ Form::open(array(
    'route' => array('categories.destroy', $category->id),
    'method' => 'delete',
)) }}

<p class="text-warning">{{{ $message }}}</p>

<p>
    <button class="btn btn-primary" type="submit">Confirm</button>
    <a href="{{ URL::previous() }}" class="btn">Cancel</a>
</p>