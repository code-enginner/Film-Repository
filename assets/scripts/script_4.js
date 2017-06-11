var target = get.byClass('WrapPrev')[0];
function previewFile() {
    var preview = get.byId('prevIMG');
    var file = document.querySelector('input[type=file]').files[0];
    var reader = new FileReader();

    // when user select an image, `reader.readAsDataURL(file)` will be triggered
    // reader instance will hold the result (base64) data
    // next, event listener will be triggered and we call `reader.result` to get
    // the base64 data and replace it with the image tag src attribute
    reader.addEventListener("load", function() {
        console.log('before preview');
        target.style.visibility = 'visible';
        target.style.opacity = 1;
        preview.src = reader.result;
        console.log('after preview');
    }, false);

    if (file) {
        console.log('inside if');
        reader.readAsDataURL(file);
    } else {
        console.log('inside else');
    }

    /*
     FLOW OF THE RESULT:

     inside if
     before preview
     after preview
     */
}
var restBTN = get.byId('reset');
var userInput = get.byClass('UserInput');
restBTN.addEventListener('click', reset);
function reset()
{
    for (var i = 0; i < userInput.length; i++)
    {
        userInput[i].value = null;
    }
    target.style.visibility = 'hidden';
    target.style.opacity = 0;
}
