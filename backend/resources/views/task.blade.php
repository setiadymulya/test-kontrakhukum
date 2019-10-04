@extends('master')

@section('content')
<div class="row justify-content-center">
   <div class="col-md-7">
      <h3 class="font-weight-light mt-10 mb-10 text-black" style="margin-bottom: 25px;">Simple Todo List</h3>
      <form class="form-inline" data-name="form-todo">
        <div class="form-group mx-sm-3 mb-2">
            <label for="inputTask2" style="padding-right: 10px;">List</label>
            <input type="text" class="form-control" name="task" id="inputTask2" />
        </div>
		  <button type="submit" class="btn btn-primary mb-2">Add Todo</button>
		</form>
		<span class="text-todo">Type in a new todo...</span>
		<form data-name="form-remove">
			<ul class="list-group"></ul>
			<button type="submit" class="btn btn-danger">Delete Selected</button>
		</form>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        const url = '{{ env("APP_URL") }}/api/v1/tasks';
		  function element(results){
				var el = '<li class="list-group-item">';
				el += '<input type="checkbox" name="task_id[]" value="'+results.code+'" class="form-control" />';
					el +=  results.task+'\n';
					el += '<span class="badge badge-danger badge-pill" data-name="deleteTask" data-code="'+results.code+'">Delete</span> \n';
				el += '</li> \n';

				return el;
		  }

		  $("input[name='task']").keyup(function(){
			  var value = $(this).val(), str = value != "" ?  value : "Type in a new todo...";
			  $(".text-todo").text(str);
		  })

		  function getData(){
				$.ajax({
					url: `${url}?total=1000`, 
					success: function(result){
						if(result.status == "success"){
							var el = "",  tasks = result.results.data;
							if(tasks.length > 0){
								tasks.forEach(function(row, idx){ el += element(row); });
								$(".list-group").append(el);
							}
						}
					}
				});
		  }

        $(document).ready(function(){
            $('form[data-name="form-remove"]').submit(function( event ) {
					event.preventDefault();
					var confirm = window.confirm("Are you sure you want to save this data?"), me = $(this)
					if(confirm == true){
						var data = $(this).serializeArray(), code = [];
						data.forEach(function(row){ code.push(row.value); });
						$.ajax({
							method: 'DELETE',
							url: `${url}`,
							data: {
								task_code: code
							},
							success: function(result){
								if(result.status == "success"){
									$('.list-group').children().remove();
									getData();
									$('form[data-name="form-remove"] .btn-danger').hide();
								}
							},
							error: function(result){
								console.log(" error >> ", result);
							}
						});	
						console.log(data);
					}
				});

            $('form[data-name="form-todo"]').submit(function( event ) {
					event.preventDefault();
					var data = $(this).serialize();
					$.ajax({
						method: 'POST',
						url: `${url}/create`, 
						data: data,
						success: function(result){
							if(result.status == "success"){
								const el = element(result.results);;
								$(".list-group").append(el);
							}
							$("input[name='task']").val("");
							$("input[name='task']").focus();
						},
						error: function(result){
							alert(result.responseJSON.errors.task[0]);
						}
					});
            });


				$(document).on("click", ".badge[data-name='deleteTask']" , function() {
					var confirm = window.confirm("Are you sure you want to save this data?"),  code = $(this).data("code"), me = $(this)
					if(confirm == true){
						$.ajax({
							method: 'DELETE',
							url: `${url}`,
							data: {
								task_code: code
							},
							success: function(result){
								if(result.status == "success"){
									me.parent().remove();
								}
							},
							error: function(result){
								console.log(" error >> ", result);
							}
						});	
					}
				});

				$(document).on("change", ".list-group-item input[type='checkbox']" , function() {
					if($(".list-group-item input[type='checkbox']:checked").length > 0){
						$('form[data-name="form-remove"] .btn-danger').show();
					} else {
						$('form[data-name="form-remove"] .btn-danger').hide();
					}
				});

				getData();
        });
    </script>
@endsection