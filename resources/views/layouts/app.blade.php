@extends('laravel-usp-theme::master')

@section('title')
  @parent 
@endsection

@section('styles')
  @parent
  <link rel="stylesheet" href="{{ asset('css/app.css').'?version=2' }}" />
  <link rel="stylesheet" href="{{ asset('css/listmenu_v.css').'?version=1' }}" />
  @if(!Auth::check())
    <style>  
        #layout_conteudo {
            padding-left: 0;
        }
    </style>
  @endif
@endsection

@section('javascripts_bottom')
  @parent
  <script type="text/javascript">
    let baseURL = "{{ env('APP_URL') }}";
  </script>
  <script type="text/javascript" src="{{ asset('js/app.js').'?version=1' }}"></script>
  <script src="{{ asset('js/datepicker-pt-BR.js').'?version=1' }}"></script>
  <script src="https://cdn.tiny.cloud/1/fluxyozlgidop2o9xx3484rluezjjiwtcodjylbuwavcfnjg/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')
<div id="layout_conteudo">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
        <p class="alert alert-{{ $msg }}">{!! Session::get('alert-' . $msg) !!}</p>
        <?php Session::forget('alert-' . $msg) ?>
        @endif
    @endforeach
    </div>
</div>
@endsection