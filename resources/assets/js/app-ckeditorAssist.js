;(function() {
    // Load and initialize CKEditor
    var editor = CKEDITOR.replace('writing-content', {
        customConfig: 'config-writing.js',
        height: 300
    });
    // Override the function of save button
    CKEDITOR.plugins.registered['save'] = {
        init : function(editor) {
            var command = editor.addCommand('save', {
                modes: {
                    wysiwyg: 1,
                    source: 1
                },
                exec: function (editor) {
                    // do something
                    var rawData = editor.getData(); // raw format data (HTML)
                    alert("@FIXME, data:\n" + rawData);
                }
            });
            editor.ui.addButton('Save', {label: '保存草稿', command: 'save'});
        }
    };
    // Upload and insert image
    $('#image-source').on('click', '#image-toggle', function() { // toggle between upload and external image
        var button = $(this), type = button.attr('aria-type'),
            upload = $('#image-upload'), external = $('#image-external');
        if (type === 'upload') {
            upload.hide();
            external.removeClass('hidden');
            button.attr('aria-type', 'external');
            button.text('或上传本地图片');
        } else {
            upload.show();
            external.addClass('hidden');
            button.attr('aria-type', 'upload');
            button.text('或选择网络图片');
        }
        $('#uploadImageModalPrompt').addClass('hidden').text('');
    });
    $('#insert-image').bind('click', function() {
        var dialog = $($(this).data('target')),
            prompt = $('#uploadImageModalPrompt'),
            toggle = $('#image-toggle').attr('aria-type'),
            upload = $('#image-upload'),
            external = $('input[name="image-external"]'),
            alternate = $('input[name="alternate"]');
        if (toggle === 'external') { // using external image
            var regexImgUrl = new RegExp('^(?:ht|f)tps?:\/\/[^$]+\.gif|jpe?g|png$');
            if (regexImgUrl.test(external.val()) !== true) {
                prompt.removeClass('hidden').text('网络图片 不是有效的图像');
                return false;
            } else {
                insertImage( external.val(), alternate.val() );
                resetUpload(dialog, prompt, true);
            }
        }
        if (toggle === 'upload') { // upload local image via ajax
            var regexUploadImg = new RegExp('\.(?:jpe?g|png|gif)$', 'i');
            if (regexUploadImg.test(upload.val()) !== true) {
                prompt.removeClass('hidden').text('本地图片 不是有效的图像');
                return false;
            } else { // upload image
                // https://api.jquery.com/jQuery.ajax/
                // https://stackoverflow.com/questions/5392344/sending-multipart-formdata-with-jquery-ajax
                // https://developer.mozilla.org/docs/Web/API/FormData/Using_FormData_Objects
                // https://developer.mozilla.org/docs/Web/API/XMLHttpRequest/Using_XMLHttpRequest#Submitting_forms_and_uploading_files
                var data = new FormData();
                data.append('image', upload[0].files[0]); // the data being send
                var opts = { // ajax settings
                    url: '/file/upload/image',
                    data: data,
                    cache: false,       // force not to cache anythings from browser
                    contentType: false, // do not set any content type header
                    processData: false, // do not process data
                    type: 'POST', // jQuery prior to 1.9.0
                    method: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    error: function(xhr, status, thrown) {
                        //console.log(xhr);
                        if (xhr.status === 422 || status === 'error') {
                            prompt.removeClass('hidden').text(xhr.responseJSON.image.join("\r\n"));
                        }
                    },
                    success: function(response) {
                        if (response.error !== true) {
                            insertImage( response.image, alternate.val() );
                            resetUpload(dialog, prompt, true);
                        } else {
                            prompt.removeClass('hidden').text(response.message);
                        }
                    }
                };
                if(data.fake) {
                    // Make sure no text encoding stuff is done by xhr
                    opts.xhr = function() {
                        var xhr = $.ajaxSettings.xhr();
                        xhr.send = xhr.sendAsBinary;
                        return xhr;
                    };
                    opts.contentType = "multipart/form-data; boundary=" + data.boundary;
                    opts.data = data.toString();
                }
                $.ajax(opts); // upload via ajax
            }
        }
    });
    var resetUpload = function(dialog, prompt, boolean) {
        var state = boolean || false;
        prompt.addClass('hidden').text(''); // restore prompt to default status
        $('input', dialog).each(function () { // empty input fields
            $(this).val('');
        });
        if (state) {
            dialog.modal('hide'); // hide the opened modal dialog
        }
    };
    var insertImage = function(src, alt) {
        var image = new Image(), width;
        image.src = src.indexOf('data:image') === -1 ? (src + '?rnd=' + Math.random()) : src;
        image.onload = function() {
            width = image.width;
            if (typeof width !== 'undefined') {
                var element = CKEDITOR.dom.element.createFromHtml('<p><img src="' + src + '" width="' + width + '" alt="' + alt + '" /></p>');
                editor.insertElement(element);
            }
        }
    };
    // Upload and insert video
    // Upload and insert audio
    // Upload and insert other multi-media file
    // Save content to the draft
    // Restore content from the writing draft
})();