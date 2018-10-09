@extends('master')
@section('title', 'Board')
@section('page-header', 'Sprint 1')

@section('content')
    <div class="row">
    	<div class="col-md-2">
    		<div class="box">
    			<div class="box-header with-border">
    				<h3 class="box-title">Backlog</h1>
    			</div>
    			<div class="box-body"></div>
    		</div>
    	</div>
    	<div class="col-md-2">
    		<div class="box">
    			<div class="box-header with-border">
    				<h3 class="box-title">Working</h1>
    			</div>
    			<div class="box-body"></div>
    		</div>
    	</div>
    	<div class="col-md-2">
    		<div class="box">
    			<div class="box-header with-border">
    				<h3 class="box-title">Reviewing</h1>
    			</div>
    			<div class="box-body"></div>
    		</div>
    	</div>
    	<div class="col-md-2">
    		<div class="box">
    			<div class="box-header with-border">
    				<h3 class="box-title">Done</h1>
    			</div>
    			<div class="box-body"></div>
    		</div>
    	</div>
    	<div class="col-md-1">
    		<button type="button" class="btn btn-default btn-md" title="Create column"> + </button>
    	</div>
    </div>
@stop
