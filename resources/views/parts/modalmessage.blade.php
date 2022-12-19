<div class="btn-group">                
    <button style="visibility: hidden" id="btn-modal-message"
            data-toggle="modal" data-target="#modal-message">
    </button>                
</div>
<div class="modal fade" id="modal-message">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    @lang('modal.modal-message.title-message')
                </h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="success" style="display: none">
                    @lang('modal.modal-message.success-message')
                </p>
                <p id="error" style="display: none">
                    @lang('modal.modal-message.error-message')
                </p>
                <p id="empty" style="display: none">
                    @lang('modal.modal-message.empty-message')
                </p>
                <p id="modal-body-message"></p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    @lang('modal.modal-message.close-message')
                </button>                
            </div>
        </div>
    </div>
</div>