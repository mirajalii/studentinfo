$(document).ready(function(){
    
    // Gender radio selection elements
    $('.checkboxes').find('label').click(function(){

        var checkedElement = $(this);

        $(checkedElement).addClass('checked');

        $(checkedElement).find('input').attr("checked",true);
    
        $(checkedElement).siblings().removeClass('checked');

        $(this).siblings().find('input').attr("checked",false);
    
    });

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



    // student record search ajax

    $('#search').keyup( function(){
        $('.body-table').addClass('ajax');

        var searchValue = $(this).val();

        var new_row = document.createElement('div');

        var rows = new_row.classList.add('row');

        var cells = document.createElement('div')

        var nodeCell = cells.classList.add('cell');

        $.ajax({

            url: "/search",
            data: { 
                name: searchValue, 
            },
            method:'GET',
            success:function(data){
                $('.body-table').removeClass('ajax');
                $('.body-table').html('');
                var QueryArray = data.data.data;
                if(QueryArray != ''){
                    QueryArray.forEach(element => {
                        document.querySelector('.body-table').innerHTML += '<div class="row"> <div class="cell"> <img src="/assets/images/' + element.image +'" />  </div> <div class="cell">' + element.name +' </div><div class="cell">' + element.roll_no +' </div><div class="cell">' + element.class +' </div><div class="cell">' + element.age +' </div><div class="cell">' + element.gender +' </div> <div class="cell">' + element.hobies +' </div><div class="cell"><span><a href="/edit-records/'+ element.id +'" class="btn btn-success">Edit</a><a href="delete-records/'+ element.id +'" class="btn btn-danger">Delete</a></span>  </div>  </div>';
    
                    }); 
                }else{
                    document.querySelector('.body-table').innerHTML += '<p class="not-found"> Search Result <b>'+ searchValue +'</b> is not found <a href="/records"> Back to lists</a> </p>';
                }
                
                               
            }
        })
    });
  
});