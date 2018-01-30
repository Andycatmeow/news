function deleteform() {
    $(document).ready(function(){
        $("#submit-article-form").remove();
    });
}
function clearform() {
    $( '#submit-article-form' ).each(function(){
        this.reset();
    });
}
function showSuccessNotifier() {
    notifier.show('Success', 'New article has been published', '', '', 6000);
}
function showDeleteNotifier() {
    notifier.show('Deleted', 'Your article has been deleted', '', '', 4000);
}

function callAdd() {

    document.getElementById("mde-data").value = simplemde.value();

    var msg   = $('#submit-article-form').serialize();

    $.ajax({
        type: 'POST',
        url: url+'home/addnews',
        data: msg,
        success: function(data) {
            $( "#result" ).after( "<div>" + data + "</div>" );
            clearform();
            showSuccessNotifier();
            simplemde.value("");
        },
        error: function(xhr, str) {
            alert('Возникла ошибка: ' + xhr.responseCode);
        }
    });
}

function callDelete(id) {
    $.ajax({
        type: 'POST',
        url: url+'home/deletenews/'+id,
        success: function(data) {
            $( ".a-"+id ).fadeOut( "slow" );
            setTimeout(function () {
                $( ".a-"+id ).remove();
            }, 1000);
            
            showDeleteNotifier();
        },
        error: function(xhr, str) {
            alert('Возникла ошибка: ' + xhr.responseCode);
        }
    });
}