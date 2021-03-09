<div class="row form-search">
    {!! Form::open(['method' => 'GET', 'role' => 'form']) !!}
    <div class="col-md-3">
        <div class="panel panel-default">

            <div class="panel-heading">
                Category
            </div>
        </div>
    </div>

        <div class="col-md-8">
            {!! Form::text('search', request()->get('search'), ['class' => 'form-control', 'placeholder' => 'Search...']) !!}
        </div>
        <div class="col-md-1">
            {!! Form::submit('Sumbit', ['class' => 'btn btn-block btn-default']) !!}
        </div>
        {!! Form::close() !!}
    </div>