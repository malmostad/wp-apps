// Methods for WPAlchemy Metaboxes, e.g. customization of boxes
jQuery(function($) {
  // Init editor for facts box
  // Copy settings from the main editor #content and extend with custom settings
  var setupEditor = function() {
    // Prevent the init to run forever if #content settings are found, should be initiated on the first few attempts
    if (attempts > 100) {
      return false;
    }
    attempts++;
    // We need to loop since the #content editor has no initiated callback
    if (tinyMCE.get('content') === null || typeof tinyMCE.get('content') === "undefined") {
      setTimeout(function() {
        setupEditor();
      }, 10);
    } else {
      var settings = tinyMCE.get('content').settings;
      $.extend(settings, {
        mode: "exact",
        elements: "metabox_facts",
        theme_advanced_buttons1: "undo,redo,|,italic,|,bullist,numlist,outdent,indent,blockquote,|,pastetext,pasteword,removeformat",
        theme_advanced_buttons3: "",
        theme_advanced_buttons4: "",
        // plugins: settings.plugins + ",table",
        // theme_advanced_buttons2: "tablecontrols",
        // table_styles: "",
        // table_cell_styles: "",
        // table_row_styles: "",
        paste_remove_spans: true,
        paste_remove_styles: true,
        paste_strip_class_attributes: "all",
        paste_text_use_dialog: true,
        //valid_elements: 'em/i',
        paste_text_sticky : true,
        remove_linebreaks : false,
        setup : function(editor) {
          editor.onInit.add(function(editor) {
            editor.pasteAsPlainText = true;
          });
        }
      });
      tinyMCE.init( settings );
    }
  };

  if (typeof tinyMCE !== 'undefined' && $('#content').length ) {
    var attempts = 0;
    setupEditor();
  }

  $('#wpa_loop-links').on('focus', '.link-url input', function() {
    if ($(this).val() === '') {
      $(this).attr('value', 'http://');
    }
  });
});
