@extends('admin.layout.main')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <!-- View sales -->
        <div class="col-xl-4 mb-4 col-lg-5 col-12">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-7">
                <div class="card-body text-nowrap">
                  <h5 class="card-title mb-0">Congratulations {{user()->user_name}}! 🎉</h5>
                  <p class="mb-2">count of Album in appication</p>
                  <h4 class="text-primary mb-1">{{$count_albums}}</h4>
                  {{-- <a href="javascript:;" class="btn btn-primary">View Sales</a> --}}
                </div>
              </div>
              <div class="col-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img
                    src="{{asset('backend/img/illustrations/card-advance-sale.png')}}"
                    height="140"
                    alt="view sales"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- View sales -->

        <!-- Statistics -->
        <div class="col-xl-8 mb-4 col-lg-7 col-12">
          <div class="card h-100">
            <div class="card-header">
              <div class="d-flex justify-content-between mb-3">
                <h5 class="card-title mb-0">Statistics</h5>
                {{-- <small class="text-muted">Updated 1 month ago</small> --}}
              </div>
            </div>
            <div class="card-body">
              <div class="row gy-3">
                <div class="col-md-6 col-6">
                  <div class="d-flex align-items-center">
                    <div class="badge rounded-pill bg-label-primary me-3 p-2">
                      <i class="ti ti-chart-pie-2 ti-sm"></i>
                    </div>
                    <div class="card-info">
                      <h5 class="mb-0">{{$count_albums}}</h5>
                      <small>Albums</small>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-6">
                  <div class="d-flex align-items-center">
                    <div class="badge rounded-pill bg-label-info me-3 p-2">
                      <i class="fas fa-city ti-sm"></i>
                    </div>
                    <div class="card-info">
                      <h5 class="mb-0">{{$count_picts}}</h5>
                      <small>Pictures </small>
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>
        <!--/ Statistics -->

        <!-- Popular Product -->
        <div class="col-md-6 col-xl-4 mb-4">
          <div class="card h-100">
            <div class="card-header d-flex justify-content-between">
              <div class="card-title m-0 me-2">
                <h5 class="m-0 me-2">Latest Albums</h5>
              </div>

            </div>
            <div class="card-body">
              <ul class="p-0 m-0">

                    @foreach ($albums as $album )
                        <li class="d-flex mb-4 pb-1">
                        <div class="me-3">
                            <img @if(count($album->pictures)>0) src="{{asset($album->pictures[0]->image)}}"@endif alt="album image" class="rounded" width="46" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">

                            </div>
                            <div class="me-2">
                            <h6 class="mb-0"> {{$album->name}}</h6>
                            </div>


                        </div>
                        </li>

                    @endforeach


              </ul>
            </div>
          </div>
        </div>
        <!--/ Popular Product -->



        <!-- Invoice table -->
        <div class="col-md-6 col-xl-6 mb-6">
          <div class="card h-100">
            <h3 style="padding: 20px 0 0 20px;">Latest Pictures</h3>
            <div class="table-responsive text-nowrap">
                <table class="table">
                  <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Album Name</th>
                        <th>Picture Name</th>
                        <th>Picture Image</th>


                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                  @foreach ($picts as $pict)
                    <tr>
                        <td >{{$loop->iteration}}</td>
                        <td>{{optional($pict->album_info)->name}}</td>
                        <td>{{$pict->name}}</td>
                        <td><img src="{{asset($pict->image)}}" class="img_pro" alt=""></td>
                    </tr>
                    @endforeach


                  </tbody>
                </table>
              </div>
          </div>
        </div>
        <!-- /Invoice table -->
      </div>
    </div>
    <!-- / Content -->



@endsection
