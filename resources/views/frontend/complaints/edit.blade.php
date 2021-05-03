@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.complaint.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.complaints.update", [$complaint->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="afa_case_number">{{ trans('cruds.complaint.fields.afa_case_number') }}</label>
                            <input class="form-control" type="text" name="afa_case_number" id="afa_case_number" value="{{ old('afa_case_number', $complaint->afa_case_number) }}" required>
                            @if($errors->has('afa_case_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('afa_case_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.complaint.fields.afa_case_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="qty_affected">{{ trans('cruds.complaint.fields.qty_affected') }}</label>
                            <input class="form-control" type="number" name="qty_affected" id="qty_affected" value="{{ old('qty_affected', $complaint->qty_affected) }}" step="1" required>
                            @if($errors->has('qty_affected'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('qty_affected') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.complaint.fields.qty_affected_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection