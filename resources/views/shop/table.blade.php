

<table class="table table-bordered border-primary mt-5">
  <thead>
    <tr>
      
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Address</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($shop as $item)
<tr>
<td>{{$item->name}}</td>
<td>{{$item->email}}</td>
<td>{{$item->address}}</td>
<td>
  <button class="btn btn-danger del" type="button" id="{{$item->id}}">Trash</button>
  <button class="btn btn-success edit" type="button" id="{{$item->id}}">Edit</button>
</td>
</tr>
@endforeach
</tbody>
   
 
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
   $('.del').on('click',function(){
    

      let id = $(this).attr('id');
      $.ajax({
                    url: "{{ route('form.destroy')}}",
                    type: 'get',
                    headers: {
                        'X-CSRF-TOKEN': "<?= Session::token() ?>"
                    },
                   
                    dataType: "Json",
                    data: {
                     id:id
                    },
                    beforeSend:function(){

$('#overlay').show();
},
                   
                    cache: false,
                    success: function (response) {
                      // console.log(response.shop);
                      if(response.success == true){
                      
                   
                      shop();
                      }
                     
                    },complete:function(){

               $('#overlay').hide();
}
                  
                   
                });    


    });

  //  edit  ////

  $('.edit').on('click',function(){
    

    let id = $(this).attr('id');
    // alert(id);
    $.ajax({
                  url: "{{ route('form.edit')}}",
                  type: 'get',
                  headers: {
                      'X-CSRF-TOKEN': "<?= Session::token() ?>"
                  },
                 
                  dataType: "Json",
                  data: {
                   id:id
                  },
                  beforeSend:function(){

$('#overlay').show();
},
                 
                  cache: false,
                  success: function (response) {
                    // console.log(response.shop);
                    if(response.success == true){

                      let name = response.data.name;
                      let email = response.data.email;
                      let address = response.data.address;
                      let id =  response.data.id;
                      $('#name').val(name);
                      $('#email').val(email);
                      $('#address').val(address);
                      $('#update_id').val(id);


                       
                 
                    shop();
                    }
                   
                  },complete:function(){

             $('#overlay').hide();
}
                
                 
              });    


  });


</script>