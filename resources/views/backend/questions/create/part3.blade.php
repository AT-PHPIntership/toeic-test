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
          <h3 class="box-title">{{$exam->title}}/{{trans('questions.question')}}/{{trans('questions.part3')}}/{{trans('questions.create')}}</h3>
        </div>
        <form action="{!!route('admin.questions.store.part3',$exam->id)!!}" enctype="multipart/form-data" method="POST">
          {{csrf_field()}}
          <div class="box-body">
            <h4 class="box-title">{{trans('questions.add_question_answer')}}</h4>
            <div class="row">
              @for($i =1; $i <= \App\Models\Part::NUMBER_QUESTION_PART_3; $i++)
                <div class="col-md-6">
                  <h4 style ="padding-top: 30px" >{{trans('question.number')}}{{$i+\App\Models\Part::START_PART_3}}:
                  <input type="text" class="form-control radio-inline part3" name="question[{{$i}}][content]" style ="width: 332px;" placeholder="Enter content question {{$i+\App\Models\Part::START_PART_3}}" value="{{old('question.'.$i.'.content')}}">
                  @if ($errors->has('question.*.content'))
                    <span class="help-block" style="color: red">{{$errors->first('question.'.$i.'.content')}}</span>
                  @endif
                  </h4>

                  @for($j=0; $j < \App\Models\Answer::NUMBER_ANSWER_PART_3; $j++)
                    <label>
                      <input  type="radio" name="question[{{$i}}][correct]" value="{{$j}}" {{ old('question.'.$i.'.correct').'' == $j.''?'checked':''}}>{{ trans('question.answer'.$j) }}
                      <input type="text" class="radio-inline" name="question[{{$i}}][answer][{{$j}}]"  value="{{old('question.'.$i.'.answer.'.$j)}}" style ="margin-right: 30px; margin-left: 15px;" placeholder="Enter Answer {{trans('question.answer'.$j) }}">
                      @if ($errors->has('question.*.answer.*'))
                        <p class="help-block" style=" color: red;">{{$errors->first('question.'.$i.'.answer.'.$j)}}</p>
                      @endif
                    </label>
                  @endfor
                    @if ($errors->has('question.*.correct'))
                      <span class="help-block" style="color: red;">{{$errors->first('question.'.$i.'.correct')}}</span>
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
