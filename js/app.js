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
function redir() {
    window.location.href = "/";
}

function closeIt(elem) {
    setTimeout(function () {
        window.location.href = "/";
    }, 2000);

    $(elem).parent().fadeOut(1000).end().remove().done();
}

$('body').on('click', '#clear_parrent_comment', function () {
    $('#Comment_parent_id').val(null);
    $('#to').html('post');
});

$('.removeComment').click(function () {
    var btn = this;
    $.ajax(
        {
            type: "POST",
            url: $(this).data('url'),
            success: function (msg) {
                location.reload();
            },
            error: function (dat) {
                alert('Something went wrong, try again leter. Datas:' + dat);
            }
        }
    );
});

var getElem = function (dat) {
    console.log(dat);
}