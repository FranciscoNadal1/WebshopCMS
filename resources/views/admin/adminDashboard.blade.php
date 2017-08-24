@extends('mainTemplates/adminTemplate')
        


       @section('content')


                {{ "Número consultas : " .  \ApiCount::getApiOfToday() }}
            
    <div id="admin">           
        @include('admin/changeCategories')
    </div>

        @endsection
