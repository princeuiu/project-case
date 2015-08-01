$(document).ready(function(){
    $("#input-id").rating();
    
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      e.target; // newly activated tab
      e.relatedTarget; // previous active tab
    })
    
    
    $('#ratingSuccessModal').on('hide.bs.modal', function (e) {
        location.reload();
    });
    
    
    /******* AJAX add to cart *****/
    
    
    $('#rate').click(function(){
        var value = new Array();
        var error = true;
        var ratingValue = 0;
        var itemNo = 0;
        for(var j = 0; j < itemCount; j++){
            itemNo = j + 1;
            //console.log($('#item-count-'+itemNo).val());
            ratingValue = 0;
            value[j] = new Array();
            value[j][0] = $('#item-count-'+itemNo).val();
            value[j][1] = $('#ratingUserEmail').val();
            value[j][2] = $('#ratingComment-'+itemNo).val();
            for(var i = 1; i <= queCount; i++){
                ratingValue = ratingValue + parseInt($('#input-'+itemNo+'-'+i).val());
                if(ratingValue > 0){
                    value[j][3] = ratingValue / queCount;
                    error = false;
                }
                else{
                    value[j]['rateing'] = 0;
                }
            }
            //console.log(value[j].join('\n'));
        }
        //console.log(value.join('\n'));
        //var data_to_send = $.param(value);
        if(error){
            ratingTitle = 'Sorry';
            ratingMsg = '<div class="alert alert-danger">Please at least Rate one, You leaved all questions not rated.</div>';
            $('#ratingSuccessModal').modal('show');
        }
        else{
            $.post(BASE+'ajax/rateings/rated',
                {"data[value]":value},
                function(e){    
                    if(e == 1){
                        ratingTitle = 'Thankyou';
                        ratingMsg = '<div class="alert alert-success">Thanks for your review.</div>';
                        $('#ratingSuccessModal').modal('show');
                    }
                    else{
                        ratingTitle = 'Sorry';
                        ratingMsg = '<div class="alert alert-danger">Can\'t accept your review now, Please try again later.<br />'+e+'</div>';
                        $('#ratingSuccessModal').modal('show');
                        //$('#ajaxMsg').html('<div class="alert alert-danger">Can\'t accept your review now, Please try again later.</div>').show();
                        //$('#ajaxMsg').html('<div class="alert alert-danger">'+e+'</div>').show();
                    }
                }
            );
        }
    });
    /******===============*********/
    
    $('#ratingSuccessModal').on('show.bs.modal', function (event) {
      var modal = $(this);
      modal.find('.modal-title').text(ratingTitle);
      modal.find('.modal-body .col-md-12').html(ratingMsg);
    });
    
    /***** AJAX add to rate ******/
    
    $('.btnAddToRate').click(function(){
        var jqObj = $(this);
        var itemId = jqObj.attr('data-item-id');
        $.post(BASE+'ajax/items/addToRate',
                {"data[id]":itemId},
                function(e){
                    if(e == true){
                        jqObj.addClass('btnRemoveFromRate');
                        jqObj.removeClass('btnAddToRate');
                        jqObj.html("Remove from Rate");
                    }
                    else{
                        console.log(e);
                    }
                }
        );
    });
    
    $('.btnRemoveFromRate').click(function(){
        var jqObj = $(this);
        var itemId = jqObj.attr('data-item-id');
        $.post(BASE+'ajax/items/removeFromRate',
                {"data[id]":itemId},
                function(e){
                    if(e == true){
                        jqObj.addClass('btnAddToRate');
                        jqObj.removeClass('btnRemoveFromRate');
                        jqObj.html("Add to Rate");
                    }
                    else{
                        console.log(e);
                    }
                }
        );
    });
    
    /***** End add to rate ******/
    
    
    
});