$(document).ready(function () {


    // product
    // edit product
    $(".editProductBtn").on("click", function () {
        $("#editProducts").modal("show");
        $tr = $(this).closest("tr");
        let data = $tr
            .children("td")
            .map(function () {
                return $(this).text();
            })
            .get();
        console.log(data);
        let category_id = $(this)
            .parents("tr")
            .find(".field-category")
            .data("category_id");
        let tag_id = $(this).parents("tr").find(".field-tag").data("tag_id");
        tag_id = tag_id.split(",");
        $(".form-tag input").prop("checked", false);
        tag_id.forEach(function (value) {
            if (value !== "") {
                $(".form-tag .tag-" + value).prop("checked", true);
            }
        });
        $("#id_editProduct").val(data[0]);
        $("#img_editProduct").attr(
            "src",
            $tr.children(".imgProductBtn").children().attr("src")
        );
        $("#name_editProduct").val(data[2]);
        $("#description_editProduct").val(data[3]);
        $("#cpuname_editProduct").val(data[4]);
        $("#ram_editProduct").val(data[5]);
        $("#harddisk_editProduct").val(data[6]);
        $("#card_editProduct").val(data[7]);
        $("#screen_editProduct").val(data[8]);
        $("#content_editProduct").val(data[9]);
        $("#category_editProduct").val(category_id);
    });
    // delete product
    $(".deleteProductBtn").on("click", function () {
        $("#deleteProduct").modal("show");
        $tr = $(this).closest("tr");
        let data = $tr
            .children("td")
            .map(function () {
                return $(this).text();
            })
            .get();
        console.log(data);
        $("#id_deleteProduct").val(data[0]);
    });
    // Product Category

    $(".editProductsCategoryBtn").on("click", function () {
        $("#editProductsCategory").modal("show");
        $tr = $(this).closest("tr");
        console.log($tr);
        let data = $tr
            .children("td")
            .map(function () {
                return $(this).text();
            })
            .get();
        console.log(data);
        $("#id_editProductCategory").val(data[0]);
        $("#name_editProductCategory").val(data[1]);
    });
});
