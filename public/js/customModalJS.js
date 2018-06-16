//modal
$('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
    e.preventDefault();
    var $form=$(this);
    $('#confirm').modal({ backdrop: 'static', keyboard: false })
        .on('click', '#delete-btn', function(){
            $form.submit();
        });
});

// pagination
$(document).ready(function() {
    $('#myPagination').DataTable();
} );

// tooltip
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
