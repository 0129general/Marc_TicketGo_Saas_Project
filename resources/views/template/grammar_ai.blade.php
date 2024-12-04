<form action="" id="myGrammarForm">
    @csrf
    <div class="row">
        <div class="col-12 mb-2" id="getkeywords">
            <div class="form-group" id="getkeywords">
                <label for="description">{{ __('Description') }}</label>
                <textarea class="form-control form-control-light mt-2" id="description" rows="3" name="description"></textarea>
            </div>
        </div>
    </div>
</form>
<div class="response">

    <a class="btn btn-primary btn-sm float-left" href="#!" id="regenerate">{{ __('Re Generate') }}</a>
    <a href="#!" onclick="copyText()" class="btn btn-primary btn-sm float-end "><i class="ti ti-copy"></i>
        {{ __('Copy Text') }}</a>
    <div class="form-group mt-3">
        {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5, 'placeholder' => __('Description'), 'id' => 'ai-description']) }}

    </div>
</div>

<script>
    $('body').ready(function() {
        if ($('.grammer_textarea').length > 0) {
            var ckdescription = CKEDITOR.instances.reply_description.getData();
            var ckvalue = $(ckdescription).text();

        } else if ($('.pc-tinymce-2').length > 0) {
            var summernoteValue = tinymce.get('requirement').getContent({
                format: "text"
            });
        } else {
            $('.summernote-simple').summernote();
            var summernoteValue = $('.summernote-simple').summernote('code');
            summernoteValue = summernoteValue.replace(/<(.|\n)*?>/g, '');
        }
        $('#description').text(ckvalue);
    })


    $('body').on('click', '#regenerate', function() {
        var form = $("#myGrammarForm");
        $.ajax({
            type: 'post',
            url: '{{ route('grammar.response') }}',
            datType: 'json',
            data: form.serialize(),
            beforeSend: function(msg) {
                $("#regenerate").empty();
                var html = '<span class="spinner-grow spinner-grow-sm" role="status"></span>';
                $("#regenerate").append(html);
            },
            afterSend: function(msg) {
                $("#regenerate").empty();
                var html =
                    `<a class="btn btn-primary" href="#!" id="regenerate">{{ __('Generate') }}</a>`;
                $("#regenerate").replaceWith(html);

            },
            success: function(data) {

                $('.response').removeClass('d-none');
                $('#regenerate').text('Re-Generate');
                if (data.message) {
                    show_toastr('error', data.message, 'error');
                    $('#commonModalOver').modal('hide');
                } else {
                    $('#ai-description').val(data);
                }
            },
        });
    });

    function copyText() {
        var selected = $('input[name="template_name"]:checked').attr('data-name');
        var copied = $("#ai-description").val();
        var input = $('input[name=' + selected + ']').length;

        if($('.grammer_textarea').length > 0){
            var ckdescription = CKEDITOR.instances.reply_description.setData(copied);
        } else if ($('textarea[name=content').hasClass('pc-tinymce-2').length > 0) {
            tinymce.get('content').setContent(copied);
        } else {
            $('textarea[name=' + selected + ']').val(copied)
        }

        show_toastr('success', 'Result text has been copied successfully', 'success');
        $('#commonModalOver').modal('hide');
    }
</script>
