@extends('admin.layout.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4 fw-bold"><span class="text-muted fw-light">Pictures /</span>
                Create Picture
            </h4>
            {{-- start row --}}
            <div class="mb-4 row">
                <!-- Browser Default -->
                <div class="mb-4 col-md mb-md-0">
                  <div class="card">
                    <h5 class="card-header">
                             Create Picture

                    </h5>
                    <div class="card-body">

                      <form class="browser-default-validation" method="post" action="{{route('Picture.store')}}" enctype="multipart/form-data">
                              {{csrf_field()}}
                                        <input type="hidden" name="album_id" value="{{$album_id}}">
                                    <div class="row">
                                        {{-- Name--}}
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="name">Name <span style="color:#f00">*</span></label>
                                            <input type="text" class="form-control" value="{{old('name')}}" required name="name" id="name"  />
                                            </div>
                                        </div>

                                        <div class="col-5">
                                            <div class="mb-3">
                                                <label class="form-label" for="name">Image <span style="color:#f00">*</span></label>
                                            <input type="file" class="form-control image"  required name="image" id="name"  />
                                            </div>
                                        </div>
                                        <div class="col-lg-1"><img src="" class="image-preview"  width="100%" /></div>


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

