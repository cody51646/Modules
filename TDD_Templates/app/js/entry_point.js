// 
$(document).ready(function(){
    $("#search_here").on('click', function(){
      //get things from user inputs
      var _val    = $("#search_input").val();
      //Check if input is empty
      if(_val !== null || _val !== ''){
            var _option = $('#column_name option:selected').text();
            if(_option.search(new RegExp("ID", "i")) == -1) 
                _val = parseInt(_val);

            var _present = null;
            // ajax to php
            
            $.ajax({
                url: "../Factory_Read.php",
                type: "POST",
                async: true, 
                // var _back = {}; _back[_option] = _val;
                //dataType: "json", data: _back,

                // data: `${key1}=value1&${key2}=value2`
                dataType: 'json',
                data: {'search': [ _option.toLowerCase() , _val]},        
                success: function(retrived_json) {
                    _present = retrived_json;
                } 
            });
            // append row to table body
            var _result_html = _present !== null ?
            `<tr><th scope="row" id='delete_id'>${_present.$id}</th><td id='delete_name'>${_present.$name}</td><td id='delete_time'>${_present.$time}</td>
            <td><button type="button" class="btn btn-danger delete_ajax_callback">Delete</button>
            </br>
            <button type="button" class="btn btn-success edit_ajax_callback">Edit</button></td>
            </tr>
            ` : '';

            $("#show_search_result").append(_result_html); 
            
            $('.update_container').on('click', '.update_ajax_callback', updateAjax);
            $('.update_container').on('click', '.create_ajax_callback', createAjax);
            $('.update_container').on('click', '.edit_ajax_callback', editAjax);
            $('.update_container').on('click', '.delete_ajax_callback', deleteAjax);

            function editAjax(){
                var append_update_tags = "<tr><th scope='row'><input type='text' id='update_id'></th><td><input type='text' id='update_name' ></td><td><input type='text' id='update_time'></td><td><button type='button' class='btn btn-warning update_ajax_callback'>Update</button></td></tr>";
                $(".update_container").append(append_update_tags);
                [id_to_update, name_to_update, time_to_update] = [ 
                                                                  parseInt($("tbody.update_container #update_id ").val()),
                                                                  $("tbo.update_container #update_name").val(), 
                                                                  $("tbody.update_container #update_time").val() 
                                                                 ];
            }
            function updateAjax(){
                [id_update_from, name_update_from, time_update_from] = [id_to_delete, name_to_delete, time_to_delete];
                if(id_to_update !== null && name_to_update !== null && time_to_update !== null)
                    $.ajax({
                        url: "../Factory_Update.php",
                        type: "POST",
                        async: true, 
                        dataType: "json",
                        data: {"back":[
                                {'id': id_update_from, 'name': name_update_from, 'time': time_update_from}, 
                                {'id': id_to_update, 'name': name_to_update, 'time': time_to_update}
                              ]},      
                        success: function() {
                                    alert("Update successfully!");
                                } 
                    });
                else alert("Nothing to update!");
            }
            function createAjax(){
               [id_to_create, name_to_create, time_to_create] = [ 
                                                                  $("#create_id input:text").val(),
                                                                  $("#create_name input:text").val(),
                                                                  $("#create_time input:text").val()
                                                                ];
                $.ajax({
                    url: "../Factory_Create.php",
                    type: "POST",
                    async: true, 
                    dataType: "json",
                    data: {'id': id_to_create, 'name': name_to_create, 'time': time_to_create},        
                    success: function() {
                                alert("Create successfully!");
                             }  
                });
            }
            
            function deleteAjax(){
                [id_to_delete, name_to_delete, time_to_delete] = [ 
                                                                  parseInt($("tbody.update_container #delete_id ").val()),
                                                                  $("tbo.update_container #delete_name").val(), 
                                                                  $("tbody.update_container #delete_time").val() 
                                                                 ];
                if(id_to_delete !== null && name_to_delete !== null && time_to_delete !== null)
                  $.ajax({
                    url: "../Factory_Delete.php",
                    type: "POST",
                    async: true, 
                    dataType: "json",
                    data: {'id': id_to_delete, 'name': name_to_delete, 'time': time_to_delete},        
                    success: function() {
                                alert("Delete successfully!");
                             } 
                  });
                
            }
            

            
       } else 
            alert("Field can't be empty!");  
            
            
    });
});

