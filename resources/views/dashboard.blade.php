@extends('layouts.app')

@section('content')
	@include('components.header')
	<!-- Page content -->
	<div class="container-fluid mt--6">
		@include('components.chart.chart')
		@include('components.footer')
	</div>
@endsection

@section('script')
	@include('components.chart.chart-js')
	@include('components.header.statistic-js')
@endsection