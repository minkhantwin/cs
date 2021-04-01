@extends('layouts.admin')

@section('content')
<div class="container">
    
    <div class="card">
        <div class="card-header text-center">
           <h2>{{ $org->name }}</h2>
        </div>

        <div class="card-body  p-5">
            
            <h5>Your Organization invitation link</h5>
            <p>http://127.0.0.1:8000/register?invite={{ $org->invite_token }}</p>

  
            <button type="button mt-2" class="btn btn-success">Re-generate link</button> 
            <br><small>Your can re-generate invite link if it is exposed to public.</small> 

            <h4 class="mt-5">Organization Member</h4>
            <table class="table table-hover mt-3">
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
@endsection
