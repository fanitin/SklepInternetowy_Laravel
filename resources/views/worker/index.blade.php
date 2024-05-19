@extends('layouts.worker')

@section('upper_title')
    Panel pracownika
@endsection

@section('main_content')
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
        <div class="inner">
            <h3>{{$orders}}</h3>

            <p>Nowe zamówienia</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="{{route('worker.order.index')}}" class="small-box-footer">Pokaż <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$categories}}<sup style="font-size: 20px">%</sup></h3>

            <p>Kategorie</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="{{route('worker.category.index')}}" class="small-box-footer">Pokaż<i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$dishes}}</h3>

            <p>Dania</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{route('worker.dish.index')}}" class="small-box-footer">Pokaż<i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
</div>
    
@endsection