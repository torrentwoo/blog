(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

;(function () {
    // Load and initialize CKEditor
    var editor = CKEDITOR.replace('writing-content', {
        customConfig: 'config-writing.js',
        height: 300
    });
    // Override the function of save button
    CKEDITOR.plugins.registered['save'] = {
        init: function init(editor) {
            var command = editor.addCommand('save', {
                modes: {
                    wysiwyg: 1,
                    source: 1
                },
                exec: function exec(editor) {
                    // fire save draft
                    var rawData = editor.getData(); // raw format data (HTML)
                    alert("@FIXME, data:\n" + rawData);
                }
            });
            editor.ui.addButton('Save', { label: '保存草稿', command: 'save' });
        }
    };
    // Upload and insert image
    $('#image-source').on('click', '#image-toggle', function () {
        // toggle between upload and external image
        var button = $(this),
            type = button.attr('aria-type'),
            upload = $('#image-upload'),
            remote = $('#image-remote');
        if (type === 'remote') {
            upload.show();
            remote.addClass('hidden');
            button.attr('aria-type', 'upload');
            button.text('或选择网络图片');
        } else {
            upload.hide();
            remote.removeClass('hidden');
            button.attr('aria-type', 'remote');
            button.text('或上传本地图片');
        }
        $('#uploadImageModalPrompt').addClass('hidden').text('');
    });
    $('#insert-image').bind('click', function () {
        var dialog = $($(this).data('target')),
            handler = dialog.attr('aria-handler'),
            prompt = $('#uploadImageModalPrompt'),
            toggle = $('#image-toggle').attr('aria-type'),
            upload = $('#image-upload'),
            remote = $('input[name="image-url"]'),
            alternate = $('input[name="alternate"]');
        if (toggle === 'remote') {
            // using external image
            var regexImgUrl = new RegExp('^(?:ht|f)tps?:\/\/[^$]+\.gif|jpe?g|png$');
            if (regexImgUrl.test(remote.val()) !== true) {
                prompt.removeClass('hidden').text('网络图片 不是有效的图像');
                return false;
            } else {
                insertImage(remote.val(), alternate.val());
                resetUpload(dialog, prompt, true);
            }
        }
        if (toggle === 'upload') {
            // upload local image via ajax
            var regexUploadImg = new RegExp('\.(?:jpe?g|png|gif)$', 'i');
            if (regexUploadImg.test(upload.val()) !== true) {
                prompt.removeClass('hidden').text('本地图片 不是有效的图像');
                return false;
            } else {
                // upload image
                // https://api.jquery.com/jQuery.ajax/
                // https://stackoverflow.com/questions/5392344/sending-multipart-formdata-with-jquery-ajax
                // https://developer.mozilla.org/docs/Web/API/FormData/Using_FormData_Objects
                // https://developer.mozilla.org/docs/Web/API/XMLHttpRequest/Using_XMLHttpRequest#Submitting_forms_and_uploading_files
                var data = new FormData();
                data.append('image', upload[0].files[0]); // the data being send
                var opts = { // ajax settings
                    url: handler,
                    data: data,
                    cache: false, // force not to cache anythings from browser
                    contentType: false, // do not set any content type header
                    processData: false, // do not process data
                    method: 'POST',
                    type: 'POST', // jQuery prior to 1.9.0
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    error: function error(xhr, status, thrown) {
                        //console.log(xhr);
                        if (status === 'error') {
                            if (_typeof(xhr.responseJSON) === 'object') {
                                prompt.removeClass('hidden').text(xhr.responseJSON.image.join("\r\n"));
                            } else {
                                prompt.removeClass('hidden').text(thrown);
                            }
                        }
                    },
                    success: function success(response) {
                        if (response.error !== true) {
                            insertImage(response.image, alternate.val());
                            resetUpload(dialog, prompt, true);
                        } else {
                            prompt.removeClass('hidden').text(response.message);
                        }
                    }
                };
                if (data.fake) {
                    // Make sure no text encoding stuff is done by xhr
                    opts.xhr = function () {
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
    var resetUpload = function resetUpload(dialog, prompt, boolean) {
        var state = boolean || false;
        prompt.addClass('hidden').text(''); // restore prompt to default status
        $('input', dialog).each(function () {
            // empty input fields
            $(this).val('');
        });
        if (state) {
            dialog.modal('hide'); // hide the opened modal dialog
        }
    };
    var insertImage = function insertImage(src, alt) {
        var image = new Image(),
            width;
        image.src = src.indexOf('data:image') === -1 ? src + '?rnd=' + Math.random() : src;
        image.onload = function () {
            width = image.width;
            if (typeof width !== 'undefined') {
                var element = CKEDITOR.dom.element.createFromHtml('<p><img src="' + src + '" width="' + width + '" alt="' + alt + '" /></p>');
                editor.insertElement(element);
            }
        };
    };
    // Upload and insert video
    // Upload and insert audio
    // Upload and insert other multi-media file
    // Save content to the draft
    // Restore content from the writing draft
})();

},{}]},{},[1]);
