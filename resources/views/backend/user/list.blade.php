@extends('backend.layouts.master')
@section('content')
<!-- page content -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{!! trans('labels.user') !!}<small>{!! trans('labels.list') !!}</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="list_users" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>{!! trans('labels.fullname') !!}</th>
                                <th>{!! trans('labels.email') !!}</th>
                                <th>{!! trans('labels.sex') !!}</th>
                                <th>{!! trans('labels.birthday') !!}</th>
                                <th>{!! trans('labels.action') !!}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if(($user->sex) == 1)
                                        {!! trans('labels.male') !!}
                                    @elseif(($user->sex) == 0)
                                        {!! trans('labels.famale') !!}
                                    @endif
                                </td>
                                <td>{{ Carbon\Carbon::parse($user->birthday)->format('d-m-Y') }}</td>
                                <td><a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>{!! trans('labels.edit') !!}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- /page content -->
@endsection