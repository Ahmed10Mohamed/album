<!-- Form with Image Modal -->
<div
    class="modal-onboarding modal fade animate__animated"
    id="onboardImageModal-{{$data->id}}"
    tabindex="-1"
    aria-hidden="true"
    >
            <div class="modal-dialog" role="document">
                <div class="modal-content text-center">
                <div class="modal-header border-0">
                    <a class="text-muted close-label" href="javascript:void(0);" data-bs-dismiss="modal"
                    >Skip Intro</a
                    >
                    <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body p-0">
                    <div class="onboarding-media">
                    <div class="mx-2">
                        <img
                        src="../../assets/img/illustrations/girl-unlock-password-light.png"
                        alt="girl-unlock-password-light"
                        width="335"
                        class="img-fluid"
                        data-app-light-img="illustrations/girl-unlock-password-light.png"
                        data-app-dark-img="illustrations/girl-unlock-password-dark.png"
                        />
                    </div>
                    </div>
                    <form class="ajsuformreloadedit" method="post" data-num="{{$data->id}}" action="{{ route('Album.update', ['Album' => $data->id]) }}" enctype="multipart/form-data">
                    <div class="onboarding-content mb-0">
                    <h4 class="onboarding-title text-body">Edit Album</h4>
                    <div class="onboarding-info">

                    </div>
                    <input type="hidden" name="_method" value="PUT" />

                        {{csrf_field()}}
                        <div id="ajsuform_yu_{{$data->id}}"></div>
                        <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                            <label for="nameEx3" class="form-label">Album Name</label>
                            <input
                                class="form-control"
                                placeholder="Enter Album name..."
                                type="text"
                                name="name"
                                value="{{$data->name}}"
                                tabindex="0"
                                id="nameEx3"
                            />
                            </div>
                        </div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                    Close
                    </button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
                </div>
            </div>
            </div>
                      <!--/ Form with Image Modal -->
