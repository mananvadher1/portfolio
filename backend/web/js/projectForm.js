$(document).ready(function () {
  $(".btn-dlt-project-img").click(function () {
    $(this).prop("disabled", true);
    let projectImageId = $(this).data("projectImgId");
    $.post("delete-project-image", { id: projectImageId })
      .done(function () {
        // console.log(".project-form__img-container-" + projectImageId);
        $("#project-form__img-container-" + projectImageId).remove();
      })
      .fail(function () {
        // console.log("fail");
        $(".btn-dlt-project-img").prop("disabled", false);
        $("#project-form__img-error-msg-" + projectImageId).text(
          "Failed to delete image"
        );
      });
  });
});
