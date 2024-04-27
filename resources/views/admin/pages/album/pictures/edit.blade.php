@extends('admin.layout.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4 fw-bold"><span class="text-muted fw-light">Pictures /</span>
                Edit Picture
            </h4>
            {{-- start row --}}
            <div class="mb-4 row">
                <!-- Browser Default -->
                <div class="mb-4 col-md mb-md-0">
                  <div class="card">
                    <h5 class="card-header">
                             Edit Picture

                    </h5>
                    <div class="card-body">

                      <form class="browser-default-validation" method="post" action="{{route('Picture.update',['Picture'=>$data->id])}}" enctype="multipart/form-data">
                              {{csrf_field()}}
                              <input type="hidden" name="_method" value="PUT" />

                                    <div class="row">
                                        {{-- Name--}}
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="name">Name <span style="color:#f00">*</span></label>
                                            <input type="text" class="form-control" value="{{$data->name}}" required name="name" id="name"  />
                                            </div>
                                        </div>

                                        <div class="col-5">
                                            <div class="mb-3">
                                                <label class="form-label" for="name">Image</label>
                                            <input type="file" class="form-control image"   name="image" id="name"  />
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <img src="{{asset($data->image)}}" class="image-preview" width="50" height="60" alt="">
                                        </div>
                                    </div>
                                    <hr>


                        <br>

                          <div class="row">
                              <div class="col-12">
                              <button type="submit" class="btn btn-primary">Submit</button>
                              </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- /Browser Default -->


              </div>

            {{-- end --}}

        </div>
        <!-- Content -->
@endsection
@section('script')
 <script src="{{asset('backend/js/ajax.js')}}"></script>
@endsection

