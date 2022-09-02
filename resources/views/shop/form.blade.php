<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <style>
   #overlay {
            background:rgba(0,0,0,0.6);
            color: #fff;
            position: fixed;
            height: 100%;
            width: 100%;
            z-index: 5000;
            top: 0;
            left: 0;
            float: left;
            text-align: center;
            padding-top: 20%;
            filter: blur(1px);
            display: none;
        }
  </style>  
  </head>
  <body>
  <div id="overlay">
            <img src="{{asset('assets/loader.gif')}}" alt="Loading" /><br/>

        </div>
    <h1 class="text-center text-danger">Online Store</h1>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>

            <div class="col-8">
            <form id="form">
  <div class="mb-3">
   
    <label  class="form-label">Product Name</label>
    <input type="text" class="form-control" name="name" id="name">
    <input type="hidden" class="form-control" name="id" id="update_id">

    <div id="name-error" style="color: red;display:none;"></div>
  </div>
 <div class="mb-3">
    <label  class="form-label">Address</label>
    <input type="text" class="form-control" name="address" id="address">
   

  </div>
   <div class="mb-3">
    <label  class="form-label">Email</label>
    <input type="email" class="form-control" name="email" id="email">
  </div>
  <!-- <button type="button" class="btn btn-primary" id="button">Submit</button> -->
  <input type="submit" class="btn btn-primary" value="Save">
</form>
    </div>

            <div class="col-2"></div>
        </div>
        
    </div>


                  <!-- table -->
         
                  <div class="container">
                    <div class="row">
                      <div class="col-2"></div>
                      <div class="col-8">
                        <div id="box">

                        </div>
                      </div>
                      <div class="col-2"></div>
                    </div>
                  </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
 <script>

   


shop();
function shop(){
                $.ajax({
                    url: "{{ route('table.show')}}",
                    type: 'get',                   
                    dataType: "Json",
                    success: function (response) {
                      // console.log(response.table);
                      
                    
                     $('#box').html(response.table);
                  
                      
                    }
                   
                });     
              }    
   
    $('#form').submit(function(e){
       e.preventDefault();
     
      
       let name = $('#name').val();
       let address = $('#address').val();
       let email = $('#email').val();
       let id = $('#update_id').val();
        
       let error  = 'no';

      if(name == ''){
          $('#name-error').html('Please Enter Your Name');
          $('#name-error').show().fadeOut(3000);;
      }

     

       $.ajax({
                    url: "{{ route('form.store')}}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "<?= Session::token() ?>"
                    },
                   
                    dataType: "Json",
                    data: {
                        name : name,
                        address : address,
                        email : email,
                        id : id
                    },
                    beforeSend:function(){

                         $('#overlay').show();
                    },
                    cache: false,
                    success: function (response) {
                      // console.log(response.shop);
                      if(response.success){
                      
                      $('#form').trigger("reset");
                      $('#update_id').val('');
                      shop();
                      }
                     
                    },
                    complete:function(){

                      $('#overlay').hide();
                    }
                   
                });
                
                

       
    });



 </script>
</body>
</html>