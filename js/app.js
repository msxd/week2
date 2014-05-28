/**
 * Created by root on 22.04.14.
 */

function scroll_to_elem(elem, speed, pid) {
    $('#Comment_parent_id').val(pid);
    $('#to').html('Comment #' + pid).append('<span id="clear_parrent_comment"> X </span>');
    if (document.getElementById(elem)) {
        var destination = jQuery('#' + elem).offset().top;
        jQuery("html,body").animate({scrollTop: destination}, speed);
    }
}
function redir(){
    window.location.href = "/";
}

function closeIt(elem) {
    setTimeout(function(){
        window.location.href = "/";
    },2000);

    $(elem).parent().fadeOut(1000).end().remove().done();
}

$('body').on('click','#clear_parrent_comment',function(){
    $('#Comment_parent_id').val(null);
    $('#to').html('post');
});