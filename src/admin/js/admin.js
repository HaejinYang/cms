$(document).ready(function () {
    $('#select_all_boxes').click(function (event) {
        if (this.checked) {
            $('.check_boxes').each(function () {
                this.checked = true;
            })
        } else {
            $('.check_boxes').each(function () {
                this.checked = false;
            })
        }
    });
});