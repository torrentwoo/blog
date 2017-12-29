(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

;(function () {
    // Load and initialize CKEditor
    var editor = CKEDITOR.replace('writing-content', {
        customConfig: 'config-writing.js',
        height: 300
    });
    // Override the button save function
    CKEDITOR.plugins.registered['save'] = {
        init: function init(editor) {
            var command = editor.addCommand('save', {
                modes: {
                    wysiwyg: 1,
                    source: 1
                },
                exec: function exec(editor) {
                    // do something
                    var data = editor.getData();
                    alert("@FIXME, data:\n" + data);
                }
            });
            editor.ui.addButton('Save', { label: '保存草稿', command: 'save' });
        }
        // Upload and insert image
    };$('#image-source').on('click', '#image-toggle', function () {
        var button = $(this),
            type = button.attr('aria-type');
        var upload = $('#image-upload'),
            external = $('#image-external');
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
    });
    $('#insert-image').bind('click', function () {
        var dialog = $($(this).data('target'));
        var message = $('#uploadImageModalMessage'),
            toggle = $('#image-toggle').attr('aria-type');
        var upload = $('#image-upload'),
            external = $('input[name="image-external"]');
        var alternate = $('input[name="alternate"]');
        //console.log(toggle);
        if (toggle === 'external') {
            var regexImgUrl = new RegExp('^(?:ht|f)tps?:\/\/[^$]+\.gif|jpe?g|png$');
            if (regexImgUrl.test(external.val()) !== true) {
                message.removeClass('hidden').text('网络图片 不是有效的图像');
                return false;
            } else {
                insertImage(external.val(), alternate.val());
            }
        }
        if (toggle === 'upload') {
            var regexUploadImg = new RegExp('\.(?:jpe?g|png|gif)$', 'i');
            if (regexUploadImg.test(upload.val()) !== true) {
                message.removeClass('hidden').text('本地图片 不是有效的图像');
                return false;
            } else {
                // do image upload
                $.post('/file/upload/image', {
                    "_method": 'POST',
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "image": upload.val()
                }, function (response) {
                    if (response.error !== true) {
                        insertImage(response.file, alternate.val());
                    } else {
                        message.removeClass('hidden').text(response.message);
                        return false;
                    }
                }, 'json');
            }
        }
        dialog.modal('hide'); // hide the opened modal dialog
        message.addClass('hidden').text(''); // restore prompt to default status
        $('input', dialog).each(function (i) {
            // empty input fields
            $(this).val('');
        });
    });
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
    // Auto-save writing draft
})();

},{}]},{},[1]);
