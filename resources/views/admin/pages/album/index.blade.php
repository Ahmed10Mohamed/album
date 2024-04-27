
@extends('admin.layout.main')

@section('content')
  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->

        <div class="card">
            <!-- card -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row me-2">
                    <div class="col-md-4">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Albums</h4>
                    </div>
                    <div class="col-md-8">
                        <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                                <button
                                type="button"
                                class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#onboardImageModal"
                                >
                                Create
                                </button>
                        </div>
                    </div>
                </div>


                @include('admin.pages.album.modal.create')


                {{-- start --}}
                <!-- Bootstrap Table with Header - Dark -->
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Album Name</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($all_data as $data )
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>
                                        <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">

                                            <a
                                                    class="dropdown-item"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#onboardImageModal-{{$data->id}}"
                                                    >
                                                <i class="ti ti-pencil me-1"></i>
                                                Edit
                                            </a>
                                            <a
                                                    class="dropdown-item"
                                                   href="{{route('Album.show',['Album' => $data->id])}}"
                                                    >
                                                <i class="ti ti-album me-1"></i>
                                                Pictures
                                            </a>
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#basicModal-{{ $data->id }}"
                                            ><i class="ti ti-trash me-1"></i> {{translate('Delete')}}</a>

                                        </div>
                                        </div>

                                    @include('admin.pages.album.modal.delete',['data'=>$data])
                                    @include('admin.pages.album.modal.edit',['data'=>$data])
                                    @include('admin.pages.album.modal.nother_album',['data'=>$data])


                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    </div>
                </div>
                <!--/ Bootstrap Table with Header Dark -->

                {{-- end --}}

            </div>
            <!-- / card -->
        </div>





  </div>

    <!-- / Content -->
@endsection
@section('script')
 <script src="{{asset('backend/js/ajax.js')}}"></script>
@endsection
