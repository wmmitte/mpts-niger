<div>
    <a href="#" title="Plus d'information sur cet employeur" data-toggle="modal"
        data-target="#attachmentShowModalEtat{{ $attachment->id }}">
        <div class="border rounded d-flex flex-column align-items-center cesw-show-file-box py-4 w-100 h-100">
            <div class="cesw-icon-section">
                <i class="fa fa-file-pdf-o fa-2xl" aria-hidden="true"></i>
            </div>
            <div class="cesw-label-section">{{ $attachment->wording }}</div>
        </div>
    </a>
    <div class="modal fade" id="attachmentShowModalEtat{{ $attachment->id }}" tabindex="-1"
        aria-labelledby="attachmentShowModalEtatLabel{{ $attachment->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Plus d'information</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="h-100">
                            <embed src="{{ "/storage/$attachment->url_file" }}" class="w-100" height="500" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</div>
