$(document).ready(function(){
    
    // Gender radio selection elements
    $('.checkboxes').find('label').click(function(){

        var checkedElement = $(this);

        $(checkedElement).addClass('checked');

        $(checkedElement).find('input').attr("checked",true);
    
        $(checkedElement).siblings().removeClass('checked');

        $(this).siblings().find('input').attr("checked",false);
    
    });

    // student record search ajax

    $('.search-box').find('input').keyup( function(){

        var searchValue = $(this).val();

        var new_row = document.createElement('div');

        new_row.classList.add('row');

        var cells = document.createElement('div')

        cells.classList.add('cell');

        $.ajax({

            url: "/records",

            method:'GET',

            dataType:'json',

            success:function(data){

                var regex =  '/' + searchValue + '/g';

                data.forEach(element => {
                    
                    console.log(element)

                    var mi = element.name;

                    var res = mi.match(regex);

                    if(res){
                    
                        console.log('abc');

                    }
                });
            }
        })
    });

});