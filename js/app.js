$(function () {

    // ajax processing to add a user

    $('#addUser').on('submit', function (e) {

        e.preventDefault();// this function prevents  page reload
        console.log($(this).serialize());
        $.ajax({
            url: "traitementAddUser.php",
            method: "post",
            data: $(this).serialize()
        }).done(function (data) {
            //$('#btnGo').attr('disabled', 'disabled');//disables the button after validation of the
            console.log(data);
            $('#tableUsers tbody').append(data);


        });
    });
});

