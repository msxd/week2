/**
 * Created by root on 22.04.14.
 */

function scroll_to_elem(elem,speed,pid) {
    $('#Comment_parent_id').val(pid);
    $('#to').html(pid);
    if(document.getElementById(elem)) {
        var destination = jQuery('#'+elem).offset().top;
        jQuery("html,body").animate({scrollTop: destination}, speed);
    }
}