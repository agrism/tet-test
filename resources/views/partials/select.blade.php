<div class="form-group col-12">
    <label for="disabledSelect">{{$label??''}}</label>
    <select class="form-control" name="{{$key}}">
        @foreach($options as $index => $value)
            <option value="{{$index}}"
                    @if(request()->session()->get($key) == $index)
                    selected
                @endif
            >{{$value}}</option>
        @endforeach
    </select>
</div>
