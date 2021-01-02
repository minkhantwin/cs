@extends('layouts.admin')

@section('admin-content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card w-100">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <h2 class="text-center">Dashboard</h2>
                    
                    <h1>Collective Survey</h1>
                    

                    <div class="row my-4">
                      <div class="col">Total member : 10</div>
                      <div class="col"><div class="btn btn-primary">Manage Member</div></div>
                      <div class="col">{{date('Y-m-d H:i:s')}}</div>
                    </div>
                      
                    <div class="card">
                        <div class="card-header">
                          <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                              <a class="nav-link active" href="#">Poll</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#">Survey</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link">Meeting</a>
                            </li>
                          </ul>
                        </div>
                        <div class="card-body">
                          
                          <div class="dropdown mb-4">
                            <button class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Active
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="#">Action</a>
                              <a class="dropdown-item" href="#">Another action</a>
                              <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                          </div>

                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                              </tr>
                              <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                              </tr>
                              <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                              </tr>
                            </tbody>
                          </table>

                        
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
