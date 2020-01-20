$(document).ready(function(){

    
    if($('.checkboxes label').hasClass('checked')){
        $('label.checked').find('input').attr("checked",true);
    }

    // Gender radio selection elements
    $('.checkboxes').find('label').click(function(){

        var checkedElement = $(this);

        $(checkedElement).addClass('checked');

        $(checkedElement).find('input').attr("checked",true);
    
        $(checkedElement).siblings().removeClass('checked');

        $(this).siblings().find('input').attr("checked",false);
    
    });

    // Image drag upload
    $('.image-upload-wrap').on('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass('dragover');
    });
    $('.image-upload-wrap').on('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
    });
    $('.image-upload-wrap').on('drop', function(e) {
        $(this).removeClass('dragover');
    })

    // show image before upload
    function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function(e) {
            $('.file-upload').find('img').attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.files[0]);
        }
    }
      
    $('.image-upload-wrap').find('input').change(function() {
        readURL(this);
    });

    // 

    $('.header .cell').find('a').text('');
    // date picker

    $("input[name='age']").datepicker({});

    $("input[name='age']").keypress( function(e){
        e.preventDefault()
    })

    $("input[name*='hobies']").keypress( function(e){
        var addSeprter = $(this).val()
        if (e.keyCode == '32') {
            $(this).val(addSeprter + ',');
          }
    })

    // Student search on from submit
    $('#submit-btn').on('click',function(e){

        $('#ajax-search').submit();
        e.preventDefault();
    });

    $('#ajax-search').submit( function(e){
        e.preventDefault();
        $('.body-table').addClass('ajax');
        $('#submit-btn').addClass('searching');
        var searchName= $(this).find('#search').val();
        var searchClass= $(this).find('select').val();
        var searchAge= $(this).find('input[name="age"]').val();
        $.ajax({

            url: "search",
            data: { 
                name: searchName,
                class: searchClass,
                age: searchAge
            },
            method:'GET',
            success:function(data){
                $('.body-table').removeClass('ajax');
                $('#submit-btn').removeClass('searching');
                if(data.html != '')
                {
                   
                    $('.body-table').html(data.html);
                }
                else
                {
                    document.querySelector('.body-table').innerHTML = '<p class="not-found"> Search Result <b> Query </b> is not found <a href="/records"> Back to lists</a> </p>';
                }
                
            },
            error: function(){
                $('#submit-btn').removeClass('searching');
                    $('.body-table').removeClass('ajax');
                    document.querySelector('.body-table').innerHTML = '<p class="not-found">please try again after some time</a> </p>';
            },
        })   
    });

    $('.roleChnages select').change( function(){
         $(this).parents('form').submit();   
         console.log(this);
    })
   
});