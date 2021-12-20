$(".btn-save").on("click", function(){

  swal.fire({
    title: "Add Task",
    html: "<b class='swal_html'>Are you sure you want to add this task?</b>",
    confirmButtonColor: 'lightgreen',
    cancelButtonColor: 'red',
    confirmButtonText: '<span style="color: white;">Proceed</span>',
    cancelButtonText: '<span style="color: white;">Cancel</span>',
    reverseButtons: true,
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {

      var empty_field_count = 0;
      var form = new FormData();

      $(".required_fields").each(function(){
        if ($(this).val() == "") {
          empty_field_count++;
        }
        else {
          form.append($(this).attr("name"), $(this).val());
        }
      });

      if (empty_field_count == 0) {
        $.ajax({
          type: "post",
          url: "/store-todo",
          processData: false,
          contentType: false,
          cache: false,
          data: form,
          dataType: "json",
          beforeSend: function(){
            loader();
          },
          success: function(data){
            setTimeout(function(){
              if (data.status == "success") {
                success();
              }
            }, 1500);
          },
        });
      }
      else {
        emptyFields("required_fields");
      }

    }
  });

});

$(".btn-save-edit").on("click", function(){

  var todo_id = $(this).attr("data-id");

  swal.fire({
    title: "Edit Task",
    html: "<b class='swal_html'>Are you sure you want to edit this task?</b>",
    confirmButtonColor: 'lightgreen',
    cancelButtonColor: 'red',
    confirmButtonText: '<span style="color: white;">Proceed</span>',
    cancelButtonText: '<span style="color: white;">Cancel</span>',
    reverseButtons: true,
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {

      var empty_field_count = 0;
      var form = new FormData();

      $(".edit_fields_"+todo_id).each(function(){
        if ($(this).val() == "") {
          empty_field_count++;
        }
        else {
          form.append($(this).attr("name"), $(this).val());
        }
      });

      if (empty_field_count == 0) {
        $.ajax({
          type: "post",
          url: "/update-todo",
          processData: false,
          contentType: false,
          cache: false,
          data: form,
          dataType: "json",
          beforeSend: function(){
            loader();
          },
          success: function(data){
            setTimeout(function(){
              if (data.status == "success") {
                success();
              }
            }, 1500);
          },
        });
      }
      else {
        emptyFields("edit_fields_"+todo_id);
      }

    }
  });

});

$(".btn-done").on("click", function(){

  var todo_id = $(this).attr("data-id");

  swal.fire({
    title: "Complete Task",
    html: "<b class='swal_html'>Complete this Task?</b>",
    confirmButtonColor: 'lightgreen',
    cancelButtonColor: 'red',
    confirmButtonText: '<span style="color: white;">Proceed</span>',
    cancelButtonText: '<span style="color: white;">Cancel</span>',
    reverseButtons: true,
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {

      var form = new FormData();

      $.ajax({
        type: "post",
        url: "/complete-todo",
        data: {todo_id: todo_id},
        dataType: "json",
        beforeSend: function(){
          loader();
        },
        success: function(data){
          setTimeout(function(){
            if (data.status == "success") {
              success();
            }
          }, 1500);
        },
      });

    }
  });

});

$(".btn-delete, .btn-delete-all").on("click", function(){

  var type = $(this).attr("data-type");

  swal.fire({
    title: "Delete Task",
    html: "<b class='swal_error'>Are you sure you want to delete Task(s)?</b>",
    confirmButtonColor: 'lightgreen',
    cancelButtonColor: 'red',
    confirmButtonText: '<span style="color: white;">Proceed</span>',
    cancelButtonText: '<span style="color: white;">Cancel</span>',
    reverseButtons: true,
    showCancelButton: true,
  }).then((result) => {
    if (result.value) {

      var form = new FormData();

      if (type == "single") {
        form.append("todo_id[]", $(this).attr("data-id"));
      }
      else {
        $(".todo-checkbox:checked").each(function(){
          form.append("todo_id[]", $(this).val());
        });
      }

      $.ajax({
        type: "post",
        url: "/delete-todo",
        processData: false,
        contentType: false,
        cache: false,
        data: form,
        dataType: "json",
        beforeSend: function(){
          loader();
        },
        success: function(data){
          setTimeout(function(){
            if (data.status == "success") {
              success();
            }
          }, 1500);
        },
      });

    }
  });

});

$(".todo-checkbox").on("click", function(){
  if ($(".todo-checkbox:checked").length >= 2) {
    $(".btn-delete-all").fadeIn();
  }
  else {
    $(".btn-delete-all").fadeOut();
  }
});

function success(){
  swal.fire({
    type: "success",
    title: "Success!",
    html: "<b class='swal_success'>Operation Successful.</b>",
    timer: 2000,
    showCancelButton: false,
    showConfirmButton: false
  }).then(function(){
    window.location.reload();
  });
}

function emptyFields(fields){
  swal.fire({
    type: "error",
    title: "Empty Fields!",
    html: "<b class='swal_error'>Please fill up all the required fields before proceeding.</b>",
  }).then(function(){
    $("."+fields).each(function(){
      if ($(this).val() == "") {
        $(this).css("border-color", "red");
      }
    });
  });
}


function loader(){
  swal.fire({
    title: "Processing please wait....",
    allowEscapeKey: false,
    allowOutsideClick: false,
    onOpen: () => {
      swal.showLoading();
    }
  });
}
