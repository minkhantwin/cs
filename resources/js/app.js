/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

const { split, forEach } = require('lodash');



/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require('./bootstrap');



// poll selector
$(function() {

    
    if( $('#noti').data('vote') === 'success' )
    {
        toastr.options.positionClass = 'toast-top-center';
        toastr.success('Voted successfully');

    }
    else if ($('#noti').data('vote') === 'fail')
    {
        toastr.options.positionClass = 'toast-top-center';
        toastr.warning('You already voted this poll!');

    }
    $('#noti').remove();


    $('#vote').on('click',function(e) {
        if($('#choiceId').val() === "")
        {
            toastr.options.positionClass = 'toast-top-center';
            toastr.options.preventDuplicates = true;
            toastr.warning('You have to select choice that you want to vote!');
            e.preventDefault();
        }

    });

    // Poll item click listener
    $('.poll-title').on('click', function() {
        const pathname = split(window.location.pathname,'/');
        window.location = "/"+pathname[1]+"/poll/"+$(this).data('poll-id');

    });

    $('.choice').on('click', function(e) {
        $('.choice-selected').removeClass('choice-selected');
        $(this).addClass('choice-selected');
        $('#choiceId').val($(this).data('choice-id'));
    });

    
    $('#pollSelection').on('change',function() {
        const id = $(this).val();
        const pathname = split(window.location.pathname,'/');
        console.log(pathname);
        if(id)
        {
            if(id === 'all')
            {
                window.location = "/"+pathname[1]+"/poll"
            }
            else{
                window.location = "/"+pathname[1]+"/poll?"+id+"=true";

            }

        }

    });


 


    


})










