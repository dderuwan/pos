<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link href="<?php echo base_url('application/modules/addon/assets/css/style.css'); ?>" rel="stylesheet" type="text/css"/>
<!-- Add new customer start -->
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title box-header">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                   
                </div>
            </div>
            <div class="panel-body">
                <?php echo form_open_multipart("printlable/module/print",array('id'=>'print'))?>
              
                    <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="date" class="col-sm-4 col-form-label">Product name</label>
                        <div class="col-sm-8">
                            <input type="text" name="product_name" required
                            class="form-control product_name productSelection"
                            onkeypress="product_list();"
                            placeholder="<?php echo display('product_name') ?>" id="product_name"
                            tabindex="5">
                        </div>
                    </div>
                    </div> 
                   <div id="price"></div>
                   <div class="col-sm-6">
                        <div class="form-group row">
                        <label for="date" class="col-sm-4 col-form-label">Expire Date</label>
                        <div class="col-sm-8">
                        <input type="date" class="form-control" name="exdate" value="" id="exdate" />
                        </div>
                        </div>
                        </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                        <label for="date" class="col-sm-4 col-form-label">Manufature Date</label>
                        <div class="col-sm-8">
                        <input type="date" class="form-control" name="mdate" value="" id="mdate" />
                        </div>
                        </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group row">
                        <label for="date" class="col-sm-4 col-form-label">Count</label>
                        <div class="col-sm-8">
                        <input type="number" class="form-control" name="count" value="" id="count" required />
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group row">
                        <div>
                            <button type="submit" class="btn btn-success m-b-5 m-r-2" id="subbutn">Print</button>
                        </div>
                    </div>
                    </div>
                </div> 
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
   
<script src="<?php echo base_url().'application/modules/addon/assets/ajaxs/addons/module.js' ?>"></script>

<script>
     
  
    function product_list() {
       
        var base_url = $('#base_url').val();
        var csrf_test_name = $('[name="csrf_test_name"]').val();
        // if ( supplier_id == 0) {
        //     alert('Please select Supplier !');
        //     return false;
        // }

        // Auto complete
        var options = {
            minLength: 0,
            source: function( request, response ) {
                var product_name = $('#product_name').val();
            $.ajax( {
              url: base_url + "printlable/module/all_product_list",
              method: 'post',
              dataType: "json",
              data: {
                term: request.term,
                product_name:product_name,
                csrf_test_name:csrf_test_name
              },
              success: function( data ) {
                // console.log(data);
                response( data );
              }
            });
          },
           focus: function( event, ui ) {
               $(this).val(ui.item.label);
               return false;
           },
           select: function( event, ui ) {
            var product_id = ui.item.value;
            $.ajax({
                type: "POST",
                url: base_url+"printlable/module/get_product_price",
                 data: {
                    csrf_test_name:csrf_test_name,
                     product_id:product_id
                },
                cache: false,
                success: function(data)
                {
                    // console.log(data);
                    var obj = JSON.parse(data);
                    var price = (obj[0].price !== null) ? obj[0].price : '';
                    var unit = (obj[0].unit !== null) ? obj[0].unit : '';
                   if(obj !=null){
                    var pricecontent = '<div class="col-sm-6">'+
                                            '<div class="form-group row">'+
                                            '<label for="date" class="col-sm-4 col-form-label">Price</label>'+
                                            '<div class="col-sm-8">'+
                                            '<input type="text" class="form-control" name="price" value="'+price+'/=" id="price" readonly/>'+
                                            '<input type="hidden" class="form-control" name="unit" value="'+unit+'" id="unit" />'+
                                            '</div>'+
                                            '</div>'+
                                            '</div>';
                    $('#price').empty();
                    $('#price').append(pricecontent);
                   }
                         
                    
                   
                } 
            });
            $(this).unbind("change");
            return false;
       }
       }

       $('body').on('keypress.autocomplete', '.product_name', function() {
           $(this).autocomplete(options);
       });

    }
</script>