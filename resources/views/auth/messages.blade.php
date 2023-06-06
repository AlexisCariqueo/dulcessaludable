@if (isset($errors) && count($errors)> 0)
    <dir class="alert alert-danger">
        <ul class="list-unstyled mb-0">
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </dir>
@endif

@if (Session::get('success',false))
    <?php $data = Session::get('success'); ?>
    @if (is_array($data))
    @foreach ($data as $message)
        <dir class="alert alert-success">
            <i class="fa fa-check"></i>
            {{$message}}
        </dir>
    @endforeach
        @else 
        <dir class="alert alert-success">
            <i class="fa fa-check"></i>
            {{$data}}
        </dir>
    @endif
@endif