<!-- 
id="modal-default"
id="modal-sm"
id="modal-lg"
id="modal-xl"
-->
<div class="modal fade" id="modal-confirm-save{{$id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    @lang('modal.modal-confirm.title-confirm')
                </h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    @lang('modal.modal-confirm.question-confirm')
                </p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    @lang('modal.modal-confirm.close-confirm')
                </button>
                <label id="process-info" style="display: none;">@lang('modal.modal-confirm.process-confirm')</label>
                <button name="btn-click" type="submit" class="btn btn-primary" >
                    @lang('modal.modal-confirm.btn-confirm')
                </button>
            </div>
        </div>
    </div>
</div>



