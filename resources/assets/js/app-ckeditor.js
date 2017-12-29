;(function() {
    // Load and initialize CKEditor
    var editor = CKEDITOR.replace('writing-content', {
        customConfig: 'config-writing.js',
        height: 300
    });
    // Override the button save function
    CKEDITOR.plugins.registered['save'] = {
        init : function(editor) {
            var command = editor.addCommand('save', {
                modes: {
                    wysiwyg: 1,
                    source: 1
                },
                exec: function (editor) {
                    // do something
                    var data = editor.getData();
                    alert(data);
                }
            });
            editor.ui.addButton('Save', {label: '保存草稿', command: 'save'});
        }
    }
    // Upload and insert image
    // Upload and insert video
    // Upload and insert audio
    // Upload and insert other multi-media file
})();