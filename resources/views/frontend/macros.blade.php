@extends('frontend.layouts.master')

@section('content')
	<div class="row">

		<div class="col-md-10 col-md-offset-1">

			<div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> {{ trans('labels.macro_examples') }}</div>

                <div class="panel-body">
                    <div class="form-group">
                        <label>{{ trans('labels.state') }}</label>
                        {!! Form::selectState('state', 'NY', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label>{{ trans('labels.country') }}</label>
                        {!! Form::selectCountry('country', 'US', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div><!-- panel -->

		</div><!-- col-md-10 -->

	</div><!-- row -->
@endsection