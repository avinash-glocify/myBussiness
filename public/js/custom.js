$(document).ready(function() {

  $(document).on('click', '.del-btn', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    swal({
      title: "Are you sure!",
      type: "error",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes!",
      showCancelButton: true,
    },
    function() {
      $.ajax({
        type: "get",
        url: url,
        success: function (data) {
          swal({
            title: "Good job!",
            text: data.success,
            icon: "success",
          });
          window.location.reload();
        }
      });
    });
  });

    var simpleEditor = new SimpleTableCellEditor("simpleEditableTable");
    simpleEditor.SetEditableClass("editMe");

    $('#simpleEditableTable').on("cell:edited", function (event) {
      const newValue = event.newValue;
      const project_id = event.element.getAttribute('data-id');
      const column = event.element.getAttribute('data-name');

      updateProjectDetail(project_id, column, newValue)

    });
    $('#is_admin').click(function(event){
        var val = [];
        $("#project_permissions input[type='checkbox']").each(function(ele){
          var attr = this.hasAttribute('disabled');
          if (attr) {
            this.removeAttribute('disabled');
          } else {
            this.setAttribute('disabled', true);
          }
        });
    });
});

  function updateProjectDetail(project_id, column, value)
  {
      const url = '/project/update';
      $.ajax({
        type: "get",
        url: url,
        data: {
          value: value,
          id: project_id,
          column: column
        },
        success: function (data) {
          if(column == 'bussiness_id') {
            const projectDetails = data.data;
            const elementValue = `gmb_listing_name_${project_id}`
            const element = document.querySelectorAll(`[data-name="${elementValue}"]`)[0];
            element.innerText = projectDetails.gmb_listing_name;
          }
        },
        error: function(data) {
          if(data.responseJSON.errors.email || data.responseJSON.errors.recovery_mail) {
            event.element.innerText=event.oldValue
            var text = data.responseJSON.errors.email
            if(data.responseJSON.errors.recovery_mail) {
              text = data.responseJSON.errors.recovery_mail;
            }
            swal({
              title: "Email Error",
              text: text,
              icon: 'error',
            });
          }
        }
      });
  }
function updatePayementStatus(event) {
  const project_id = event.target.getAttribute('data-id');
  const column = event.target.getAttribute('data-name');
  const value = event.target.value;
  if(value != '') {
    updateProjectDetail(project_id, column, value)
  }
}
