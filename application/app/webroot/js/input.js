$(function () {
	"use strict";
	var BASE_URL = "../samples";
	var HTTP_BAD_REQUEST = 400;
	var HTTP_NOT_FOUND = 404;
	var id = $.url().param()["id"];

	if (id) {
		$.ajax({
			url : BASE_URL + "/" + id + ".json",
			type : "GET",
			dataType : "json",
			success : function (data) {
				$("input[name=text1]").val(data.text1);
			},
			error : function(xhr, textStatus, errorThrown) {
				alert("[id=" + id + "]" + xhr.status + ":" + textStatus + ":"
						+ errorThrown);
			},
		});
	}

	$("#form1").on("submit", function () {
		var $message = $("#message");
		$.ajax(BASE_URL + (id ? "/" + id : ""), {
			type : "POST",
			data : $("#form1").serialize(),
			success : function (responseText) {
				$message.text(responseText);
			},
			error : function(xhr, textStatus, errorThrown) {
				if (xhr.status === HTTP_BAD_REQUEST) {
					$message.text(xhr.responseText);
				} else if (xhr.status === HTTP_NOT_FOUND) {
					$message.text("ID is not found");
				} else {
					alert(xhr.status + ":" + textStatus + ":" + errorThrown);
				}
			},
			complete : function () {
				$("#back").show();
			}
		});

		// prevent default
		return false;
	});

	$("#back").hide();
});
