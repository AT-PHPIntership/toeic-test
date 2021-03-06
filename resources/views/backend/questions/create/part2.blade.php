@extends('backend.layouts.master')
@section('content')
<div class="row">
@if(Session::has('success'))
  <div class="alert alert-success">
      {{ Session::get('success') }}
  </div>
@endif
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$exam->title}}/{{trans('questions.question')}}/{{trans('questions.part2')}}/{{trans('questions.create')}}</h3>
        </div>
        <form action="{!!route('admin.questions.store.part2',$exam->id)!!}" enctype="multipart/form-data" method="POST">
          {{csrf_field()}}
          <div class="box-body">
            <h4 class="box-title">{{trans('questions.add_question_answer')}}</h4>
            <div class="row">
                  @for($i =1; $i <= \App\Models\Part::NUMBER_QUESTION_PART_2; $i++)
                    <div class="col-md-4" style="padding-left: 70px">
                      <h4 style ="padding-top: 30px" >{{trans('question.number')}}{{$i+\App\Models\Part::START_PART_2}}:
                      @for($j=0; $j < \App\Models\Answer::NUMBER_ANSWER_PART_2; $j++)
                        <label class="radio-inline">
                          <input  type="radio" name="question[{{$i}}][correct]" value="{{$j}}" {{ old('question.'.$i.'.correct').'' == $j.''?'checked':''}}>{{ trans('question.answer'.$j) }}
                        </label>
                      @endfor
                      </h4>
                        @if ($errors->has('question.*.correct'))
                          <span style="color: red" class="help-block">{{$errors->first('question.'.$i.'.correct')}}</span>
                        @endif
                    </div>
                  @endfor
            </div>
          </div>
          <div class="box-footer text-center">
            <a style="color: #ffffff" href=""><button style="width: 110px" type="button" class="btn  btn-warning"><i class="fa fa-step-backward" aria-hidden="true"></i>{{trans('part.previous_step')}}</button></a>
            <a style="color: #ffffff;" href="{{route('admin.exams.index')}}"><button style="width: 110px" type="button" class="btn btn-primary">{{trans('backend.cancel')}}</button></a>
            <a style="color: #ffffff" href=""><button type="submit" class="btn  btn-success">{{trans('part.next_step')}}<i class="fa fa-step-forward" aria-hidden="true"></i></button></a>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
