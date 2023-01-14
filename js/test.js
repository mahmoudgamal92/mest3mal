/**
 * Created by alweseemy on 6/21/2020.
 */
<script>
$(function() {
    var loader = $("#fullloader");
    var wordCountFromTyping = false;
    var txtAreaForContent = $("#Content");
    var totalWordCount = $("#totalWordCount");
    var selService = $("#selService");
    var selTypeOfDoc = $("#selTypeOfDoc");
    var selUrgency = $("#selUrgency");
    var selTypeOf = $("#selTypeOf");
    var liTypeOf = $("#liTypeOf");
    var uploadedWrapper = $("#uploaded-wrapper");
    var selPrice = $("#selPrice");
    var inputWordCount = $("#WordCount");
    var orderSummaryWell = $('#order-summary-well');
    var forStatisticalAnalysis = $('#forStatisticalAnalysis');
    var fixmeTop = orderSummaryWell.offset().top;
    var urgencyId = $("#UrgencyId");

    $("#divTranslation input[type=radio][name=IsFileUpload]").on("change",
        function() {
            // console.log($(this).val());
            if ($(this).val() == "True") {
                $("#typeText").slideUp();
                $("#fileUpload").slideDown();
                wordCountFromTyping = false;
                wordCount();
            } else {
                $("#fileUpload").slideUp();
                $("#typeText").slideDown();
                wordCountFromTyping = true;
                wordCount();
            }
        });

    txtAreaForContent.on('keyup',
        function() {
            wordCount();
        });

    $("#radio-button-bg input[type=radio]").on("change",

        function() {
            var obj = $(this);
            //console.log($(this).next().text());
            //var forTypeText = $("#forTypeText");
            //var onlyforssr = $("#onlyforssr");


            $("#forStatisticalAnalysis #ProductId").val(obj.val());
            if (obj.val() == 5) {
                forStatisticalAnalysis.stop().slideDown();
                $("#forTypeText").addClass("hidden");
                $("#onlyforssr").removeClass("hidden");
            } else if (forStatisticalAnalysis.is(':visible')) {
                forStatisticalAnalysis.stop().slideUp();
                if ($("#forTypeText").hasClass("hidden")) {
                    $("#forTypeText").removeClass("hidden");
                }
                if (!$("#onlyforssr").hasClass("hidden")) {
                    $("#onlyforssr").addClass("hidden");
                }
            }

            resetService();
            selService.text($(this).next().text());
            loadSelect("/ar/MyData/GetProductCategoy/" + $(this).val(),
                $("#ProductCategoyId"),
                "الرجاء التحديد",
                "undefined",
                "start");
            loadSelect("/ar/MyData/GetUrgency/" + $(this).val(),
                $("#UrgencyId"),
                "الرجاء التحديد",
                "undefined",
                "undefined");
            loadSelect("/ar/MyData/GetTypeOfProduct/" + $(this).val(),
                $("#TypeOfProductId"),
                "الرجاء التحديد",
                $("#divTypeOfProductId"),
                "end");
        });

    $("#ProductCategoyId").on("change",
        function() {
            selTypeOfDoc.text($("option:selected", this).text());
            getPrice();
        });
    $("#UrgencyId").on("change",
        function() {
            selUrgency.text($("option:selected", this).text());
            getPrice();
        });
    $("#TypeOfProductId").on("change",
        function() {
            selTypeOf.text($("option:selected", this).text());
            getPrice();
        });
    $("#AccecptTerms").on("change",
        function() {
            if ($(this).is(":checked")) {
                $("#continue").removeAttr("disabled");
            } else {
                $("#continue").attr("disabled", "disabled");
            }
        });
    inputWordCount.on("blur",
        function() {
            getPrice();
        });

    $("#forStatisticalAnalysis input, #Content").on("blur",
        function() {
            getPrice();
        });

    /* file upload*/
    $(".content-file").on("change",
        function() {
            // console.log(this.files[0]);
            if (this.files.length > 0) {
                var file = this.files[0];
                var formData = new FormData();
                formData.append("ContentUpload", file);
                formData.append("guid", "9558a357-6d84-4066-8b61-4b7b18420355");
                console.log($("input[name='__RequestVerificationToken']").first());
                formData.append("__RequestVerificationToken",
                    $("input[name='__RequestVerificationToken']").first().val());
                loader.show();
                $.ajax({
                    type: 'post',
                    url: '/ar/mydata/Upload',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        //  alert('succes!!');
                        console.log("succes");
                        console.log(response);
                        uploadedWrapper
                            .append("<div class='alert alert-info wordcount-wrapper' data-id='" +
                                response.id +
                                "' data-wc='" +
                                response.wordCount +
                                "'>" +
                                file.name +
                                " (" +
                                response.wordCount +
                                ")" +
                                "<i class='fa fa-times-circle-o' aria-hidden='true'></i></div>");
                        // $("#totalWordCount").text(response.wordCount);
                        wordCount();
                        getPrice();
                    },
                    error: function(error) {
                        console.log("error");
                        console.log(error);
                    }
                }).always(function() {
                    loader.hide();
                });;

            }


        });

    $("#uploaded-wrapper").on('click', ".wordcount-wrapper i", function () {

        var parent = $(this).parent();
        var formData = new FormData();
        formData.append("id", parent.data("id"));
        formData.append("__RequestVerificationToken",
            $("input[name='__RequestVerificationToken']").first().val());
        loader.show();
        $.ajax({
            type: 'post',
            url: '/ar/mydata/DeleteUploadFileById',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                //  alert('succes!!');
                console.log("file removed");
            },
            error: function(error) {
                console.log("error");
                console.log(error);
            }
        }).always(function() {
            loader.hide();
            parent.remove();
            wordCount();
            getPrice();
        });;

    });

    function wordCount() {
        var totalCount = 0;
        if (wordCountFromTyping) {
            var txt = txtAreaForContent.val();
            if (txt.length == 0) {
                totalWordCount.text("");
                inputWordCount.val("");
            } else {
                //var words = txtAreaForContent.val().trim().replace(/[^\w ]/g, "").split(/\s+/);
                //var newwords = txtAreaForContent.val().trim().replace(/\n/g, " ").split(/\s+/).filter(function (v) { return v !== '' });
                //var words = txtAreaForContent.val().split(' ').filter(function (v) { return v !== ''  });
                //console.log(newwords);
                //console.log(newwords.lenght);
                //	var wc = txtAreaForContent.val().trim().replace(/[^\w ]/g, "").split(/\s+/).length;
                //	var wc = txtAreaForContent.val().split(' ').filter(function (v) { return v !== '' }).length;
                var wc = txtAreaForContent.val().trim().replace(/\n/g, " ").split(/\s+/).filter(function(v) { return v !== '' })
                    .length;
                // totalWordCount.text(txtAreaForContent.val().replace(/[^\w ]/g, "").split(/\s+/).length);
                totalWordCount.text(wc);
                inputWordCount.val(wc);
            }
        } else {
            $(".wordcount-wrapper").each(function(i, e) {
                totalCount = totalCount + parseInt($(this).data("wc"));
                //console.log(this);
                //console.log($(this).data("wc"));
                //console.log(i);
            });
            totalWordCount.text(totalCount);
            inputWordCount.val(totalCount);
        }
        var curProductId = parseInt($("#forStatisticalAnalysis #ProductId").val());
        //  console.log(totalCount);
        if (totalCount > 0 && curProductId == 1 || curProductId == 3) {
            reSetUrgency();
        }
    }

    function reSetUrgency() {
        console.log("inside reset");
        var tCount = parseInt(inputWordCount.val());
        if (tCount > 0) {
            var results = urgencyId.find("option");
            //	console.log(options);
            urgencyId.attr("disabled", "disabled");
            urgencyId.empty();
            //options.append($("<option />").val("").text("الرجاء التحديد"));
            $.each(results,
                function(i, item) {
                    console.log(parseInt(tCount / 250));
                    //console.log(i, (i + 1) * 10, noOfPages.val());
                    //console.log((i + 1) * 10 >= parseInt(noOfPages.val()));
                    //console.log(i < 5);
                    //console.log((i + 1) * 10 <= parseInt(noOfPages.val()) && i < 5);
                    if (i > 0 && ((i * 10) <= parseInt(tCount / 250) && i < 5)) {
                        urgencyId.append($(item).addClass("hidden"));
                    } else {
                        urgencyId.append($(item).removeClass("hidden"));
                    }

                });
            urgencyId.removeAttr("disabled");
            //urgencyId.trigger("change");
        }
        //console.log(tCount);

    }

    function loadSelect(url, options, msg, wrapper, isLoad) {
        // console.log(loader);
        if (isLoad !== "undefined" && isLoad === "start") {
            loader.show();
        }
        //  console.log(wrapper);
        $.getJSON(url,
            function(result) {
                // console.log(result.length);

                if (result.length == 0 && wrapper !== "undefined" && $(wrapper).is(':visible')) {
                    // wrapper.css("display", "none");
                    // console.log(result);
                    //  console.log("hiding wrapper");
                    $(wrapper).slideUp();
                    //  console.log("hiding li");
                    liTypeOf.slideUp();
                } else {

                    options.attr("disabled", "disabled");
                    options.empty();
                    options.append($("<option />").val("").text(msg));
                    $.each(result,
                        function(i, item) {
                            options.append($("<option />").val(item.id).text(item.name));
                        });
                    options.removeAttr("disabled");
                    options.trigger("change");
                    if (result.length > 0 && wrapper !== "undefined" && !$(wrapper).is(':visible')) {
                        //console.log(result);
                        //console.log("showing wrapper");
                        $(wrapper).slideDown();
                        // console.log("showing li");
                        liTypeOf.slideDown();
                    }
                }
            }).always(function() {
            if (isLoad !== "undefined" && isLoad === "end") {
                loader.hide();
            }
        });;
    };


    function resetService() {
        uploadedWrapper.empty();
        removeFiles();
        wordCount();
        selPrice.text("");
    }

    function getPrice() {

        console.log($("#UrgencyId").val());
        //console.log($("#TypeOfProductId").val());
        if ($("#UrgencyId").val() != "") {
            console.log("getting price");
            var formData = new FormData();
            formData.append("productId", $("#radio-button-bg input[type='radio']:checked").val());
            formData.append("UrgencyId", $("#UrgencyId").val());
            formData.append("TypeOfProductId", $("#TypeOfProductId").val());
            formData.append("WordCount", inputWordCount.val());
            formData.append("PrimaryData", $("#PrimaryData").val());
            formData.append("NumberOfAxles", $("#NumberOfAxles").val());
            formData.append("ProductCategoyId", $("#ProductCategoyId").val());
            formData.append("NumberOfPhrasesPerAxis", $("#NumberOfPhrasesPerAxis").val());
            // console.log($("input[name='__RequestVerificationToken']").first());
            formData.append("__RequestVerificationToken",
                $("input[name='__RequestVerificationToken']").first().val());
            loader.show();
            $.ajax({
                type: 'post',
                url: '/ar/mydata/GetPrice',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    //  alert('succes!!');
                    selPrice.text("ر.س " + response);
                    console.log("succes");
                    console.log(response);
                },
                error: function(error) {
                    console.log("error");
                    console.log(error);
                }
            }).always(function() {
                loader.hide();
            });;
        }
    }

    function removeFiles() {
        var formData = new FormData();
        formData.append("guid", "9558a357-6d84-4066-8b61-4b7b18420355");
        formData.append("__RequestVerificationToken",
            $("input[name='__RequestVerificationToken']").first().val());
        loader.show();
        $.ajax({
            type: 'post',
            url: '/ar/mydata/DeleteUploadFile',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                //  alert('succes!!');
                console.log("file removed");
            },
            error: function(error) {
                console.log("error");
                console.log(error);
            }
        }).always(function() {
            loader.hide();
        });;

    }

    $(window).scroll(function() { // assign scroll event listener

        var currentScroll = $(window).scrollTop(); // get current position

        if (currentScroll >= fixmeTop) { // apply position: fixed if you
            console.log("if " + $(window).scrollTop());
            if (!orderSummaryWell.hasClass("order-summary-well")) {
                orderSummaryWell.addClass("order-summary-well");
            }
        } else { // apply position: static
            console.log("else " + $(window).scrollTop());
            if (orderSummaryWell.hasClass("order-summary-well")) {
                orderSummaryWell.removeClass("order-summary-well");
            }
        }

    });
    //wordCount();
    //$("#ProductCategoyId,#UrgencyId").trigger("change");
    selTypeOfDoc.text($("option:selected", $("#ProductCategoyId")).text());
    $("#UrgencyId").trigger("change");
});




</script>

<script type="text/javascript">
    $(document).ready(function() {
        //         $.getJSON("/en/MyData/GetUncompleteOrder", function (result) {
        //             if (result != '0') {
        //                 $("#order-badge").html(result).show();
        //             }
        //});
        $.getJSON("/en/MyData/GetUnreadMsg",
            function(result) {
                if (result != '0') {
                    $("#order-badge").html(result).show();
                }
            });
    });
</script>
