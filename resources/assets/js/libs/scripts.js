
$(document).ready(function(){

    function ajaxForm(form , successFunc , errorFunc)
    {
    $.ajax({
         type: form.attr('method'),
         url: form.attr('action'),
         data: form.serialize(),
         success: function(data){
            successFunc(data);
         },
         error: function(error){
            errorFunc(error);
         } 
    });
}

    /*
        Delete User Ajax
    */
    $('.deleteUser').on('submit', function(e){
        e.preventDefault();
        var form = $(this);

        if(confirm('Are you sure?'))
        {
           ajaxForm(form, function(data){
                if(data.deleted)
                    $('#usersTable').load(location.href + ' #usersTable');
                
           } , function(error){});

        }

    });



    /*
        Delete Post Ajax
    */

    $('.deletePost').on('submit', function(e){
        e.preventDefault();
        var form = $(this);

        if(confirm('Are you sure?'))
        {
            ajaxForm(form, function(data){

                if(data.deleted)
                     $('#postsTable').load(location.href + ' #postsTable');

            } , function(error){});
        }
    });

    /*
        Delete Category Ajax
    */
    $('.deleteCategory').on('submit' , function(e){
        e.preventDefault();
        var form = $(this);

        if(confirm('Are you sure?'))
        {
            ajaxForm(form, function(data){
                if(data.deleted)
                    $('#categoriesTable').load(location.href + ' #categoriesTable');
            }
            , function(error){
                console.log(error);
            });
        }
    });

    /*
        Delete Media Ajax
    */
    $('.deleteMedia').on('submit', function(e){
        e.preventDefault();
        var form = $(this);

        if(confirm('Are you sure?'))
        {
            ajaxForm(form , function(data){
                if(data.deleted)
                    $('#mediaTable').load(location.href + ' #mediaTable');
                else if(data.notdeleted)
                    alert(data.notdeleted);
            }, 
            function(error)
            {console.log(error)} );
        }
    });




    $('#selectAllBoxes').click(function(event){

        if(this.checked) {

            $('.checkBoxes').each(function(){

                this.checked = true;

            });

        } else {


            $('.checkBoxes').each(function(){

                this.checked = false;

            });


        }

    });





    /**************** User Profile **********************/



    var panels = $('.user-infos');
    var panelsButton = $('.dropdown-user');
    panels.hide();

    //Click dropdown
    panelsButton.click(function() {
        //get data-for attribute
        var dataFor = $(this).attr('data-for');
        var idFor = $(dataFor);

        //current button
        var currentButton = $(this);
        idFor.slideToggle(400, function() {
            //Completed slidetoggle
            if(idFor.is(':visible'))
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-up text-muted"></i>');
            }
            else
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-down text-muted"></i>');
            }
        })
    });


    $('[data-toggle="tooltip"]').tooltip();

    //$('button').click(function(e) {
    //    e.preventDefault();
    //    alert("This is a demo.\n :-)");
    //});






});