   <!-- Modal -->
   <div class="modal fade" id="basicModal-{{ $data->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">{{translate('Delete Picture')}}</h5>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
            ></button>
            </div>
            <form role="form" action="{{ url('Picture/'.$data->id) }}" class="" method="POST">
            <div class="modal-body">

                <input name="_method" type="hidden" value="DELETE">
                {{ csrf_field() }}
                <p>{{translate('Are You Sure?')}}</p>




            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                {{translate('Close')}}
            </button>


            <button type="submit" class="btn btn-danger" name='delete_modal'><i class="fa fa-trash" aria-hidden="true"></i> {{translate('Delete')}}</button>
            </a>
            </div>
        </form>
        </div>
        </div>
    </div>

        {{-- end --}}
