@extends('layouts.blank.errors')
@section('title', __('Accès interdit'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
