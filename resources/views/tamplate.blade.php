@extends('admin.layout.app')
@section('main')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Category</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Category</li>
                        </ol>
                    </div>
                </div>
               
            </div>
           
        </div>
        <div class="app-content">

            <div class="card">
                <div class="card-header">
                {{-- Titel goes here --}}
                </div>
                <div class="card-body">
                    {{-- Content Goes her --}}
                </div>
            </div>
         
        </div>
        
    </main>
@endsection
