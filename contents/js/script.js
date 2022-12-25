const status = document.getElementById('status');
const output = document.getElementById('output');
if (window.FileList && window.File && window.FileReader) {
  document.getElementById('file-selector').addEventListener('change', event => {
    output.src = '';
    status.textContent = '';
    const file = event.target.files[0];
    if (!file.type) {
      status.textContent = 'Error: The File type property does not appear to be supported on this browser.';
      return;
    }
    if (!file.type.match('image.*')) {
      status.textContent = 'Error: The selected file does not appear to be an image.'
      return;
    }
    const reader = new FileReader();
    reader.addEventListener('load', event => {
      output.src = event.target.result;
    });
    reader.readAsDataURL(file);
  });
}


$(document).ready(function() {
  $('#font-family').change(function() {
    var font_family = $(this).val();
    $('#text').css('font-family', '"'+font_family+'"');
  });
});

$(document).ready(function() {
  $('#font-size').change(function() {
    var font_size = $(this).val();
    $('#text').css('fontSize', font_size+"px");
  });
});


$(document).ready(function() {
  $('#fonts').submit(function() {
    $('#status').html("<b>Printing text...</b>");
    $.ajax({
        type: 'POST',
        url: 'index.php',
        data: $(this).serialize()
      })
      .done(function() {
        $('#status').html("<b>Printed !</b>");
        setInterval(function() {
          $('#status').html("Waiting...");
        }, 15000);
      })
      .fail(function() {
        alert("Posting failed.");
      });
    return false;
  });
});

$(document).ready(function() {
  $('#images').submit(function() {
    $('#status').html("<b>Printing image...</b>");
    $.ajax({
        type: 'POST',
        url: 'index.php',
        data: $(this).serialize()
      })
      .done(function() {
        $('#status').html("<b>Printed :)</b>");
        setInterval(function() {
          $('#status').html("Waiting...");
        }, 15000);
      })
      .fail(function() {
        alert("Posting failed.");
      });
    return false;
  });
});
